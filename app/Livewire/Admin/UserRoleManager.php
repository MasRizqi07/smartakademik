<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('layouts.app')]
class UserRoleManager extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterRole = '';

    // Modal Create / Edit
    public bool $isModalOpen = false;
    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $role = 'guru';
    public string $password = '';

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'role' => 'required|string',
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
        ];
    }

    public function openCreateModal(): void
    {
        $this->reset(['userId', 'name', 'email', 'role', 'password']);
        $this->role = 'guru';
        $this->isModalOpen = true;
    }

    public function openEditModal(int $id): void
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()?->name ?? 'guru';
        $this->password = '';
        $this->isModalOpen = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            if (!empty($this->password)) {
                $user->password = Hash::make($this->password);
            }
            $user->save();
            $user->syncRoles([$this->role]);

            session()->flash('message', "Pengguna {$this->name} berhasil diperbarui.");
        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole($this->role);

            session()->flash('message', "Pengguna {$this->name} berhasil ditambahkan.");
        }

        $this->isModalOpen = false;
        $this->reset(['userId', 'name', 'email', 'role', 'password']);
    }

    public function deleteUser(int $id): void
    {
        if ($id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        session()->flash('message', "Pengguna {$name} berhasil dihapus dari sistem.");
    }

    public function render()
    {
        $roles = Role::all();

        $users = User::with('roles')
            ->when(!empty($this->search), function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when(!empty($this->filterRole), function ($q) {
                $q->whereHas('roles', fn($r) => $r->where('name', $this->filterRole));
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-role-manager', [
            'users' => $users,
            'roles' => $roles,
            'totalUsers' => User::count(),
            'adminCount' => User::role('admin_tu')->count(),
            'guruCount' => User::role('guru')->count(),
            'siswaCount' => User::role('siswa')->count(),
            'wakaCount' => User::role('waka_kurikulum')->count(),
        ]);
    }
}
