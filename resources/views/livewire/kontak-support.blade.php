<div class="space-y-8">
    <div class="mb-4">
        <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-text-main">Pusat Bantuan &amp; Kontak</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Hubungi tim IT Support MAN 4 Jombang untuk bantuan teknis sistem atau kendala akun.</p>
    </div>

    @if (session()->has('ticket_success'))
        <div class="p-5 bg-status-hadir/15 border border-status-hadir/30 text-status-hadir rounded-2xl flex items-center gap-3 font-medium shadow-xs">
            <span class="material-symbols-outlined text-[28px]">verified</span>
            <div>
                <p class="font-bold text-base">Tiket Terkirim!</p>
                <p class="text-xs text-status-hadir/90">{{ session('ticket_success') }}</p>
            </div>
        </div>
    @endif

    <!-- Bento Grid Layout for Contact Info -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Main Contact Form (7 Cols) -->
        <div class="lg:col-span-7 bg-surface-container-lowest rounded-2xl shadow-card border border-border-default overflow-hidden">
            <div class="p-6 border-b border-border-default bg-surface flex items-center justify-between">
                <h3 class="font-headline-md text-lg font-bold text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    <span>Formulir Tiket Bantuan IT</span>
                </h3>
                <span class="text-xs bg-primary/10 text-primary px-2.5 py-0.5 rounded-full font-semibold">Respon Cepat</span>
            </div>

            <form wire:submit.prevent="submitTicket" class="p-6 md:p-8 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-label-md text-sm text-on-surface mb-1.5 font-semibold">Nama Lengkap</label>
                        <input wire:model="nama" class="w-full h-touch-target rounded-lg border border-border-default bg-surface px-4 font-input-text text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="Masukkan nama Anda" type="text" required />
                    </div>
                    <div>
                        <label class="block font-label-md text-sm text-on-surface mb-1.5 font-semibold">Email / NIP / NISN</label>
                        <input wire:model="emailOrId" class="w-full h-touch-target rounded-lg border border-border-default bg-surface px-4 font-input-text text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="email@contoh.com atau NIP" type="text" required />
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-sm text-on-surface mb-1.5 font-semibold">Kategori Kendala</label>
                    <div class="relative">
                        <select wire:model="kategori" class="w-full h-touch-target rounded-lg border border-border-default bg-surface px-4 font-input-text text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none appearance-none cursor-pointer">
                            <option value="login">Masalah Login / Reset Password</option>
                            <option value="attendance">Kendala Input Presensi Kelas</option>
                            <option value="grades">Sistem Nilai Formatif TP</option>
                            <option value="schedule">Jadwal Mengajar / Konflik Ruang</option>
                            <option value="other">Pertanyaan Administrasi Umum</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div>
                    <label class="block font-label-md text-sm text-on-surface mb-1.5 font-semibold">Deskripsi Kendala</label>
                    <textarea wire:model="pesan" class="w-full rounded-lg border border-border-default bg-surface p-4 font-input-text text-sm text-on-surface focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none resize-none" placeholder="Jelaskan kendala Anda secara detail agar tim IT dapat langsung menindaklanjuti..." rows="4" required></textarea>
                </div>

                <div class="pt-2 flex items-center justify-between">
                    <p class="text-xs text-on-surface-variant">Data Anda aman dan ditangani oleh IT Madrasah.</p>
                    <button class="px-8 h-touch-target bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-md text-sm font-semibold shadow-sm transition-all active:scale-[0.98] flex items-center justify-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-[20px]">send</span>
                        <span>Kirim Tiket</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info & Live Support Column (5 Cols) -->
        <div class="lg:col-span-5 space-y-6 flex flex-col">
            <!-- IT Support Contact Card -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default p-6 relative overflow-hidden group">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-xl flex items-center justify-center shadow-xs">
                        <span class="material-symbols-outlined text-[26px]">support_agent</span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-lg font-bold text-on-surface">Unit IT Support Madrasah</h3>
                        <p class="text-xs text-status-hadir font-semibold flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-status-hadir"></span> Siaga pada Jam Operasional
                        </p>
                    </div>
                </div>

                <div class="space-y-3 pt-2 text-sm">
                    <div class="flex items-start gap-3 p-3 bg-surface rounded-xl border border-border-default/60">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">call</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Hotline IT (07.00 - 16.00 WIB)</p>
                            <p class="font-bold text-text-main">(0321) 861234 ext. 102</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-3 bg-surface rounded-xl border border-border-default/60">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">mail</span>
                        <div>
                            <p class="text-xs text-on-surface-variant">Email Dukungan Resmi</p>
                            <p class="font-bold text-text-main">support@man4jombang.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Tracker Widget -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default p-6 space-y-4">
                <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">search_check</span>
                    <span>Cek Status Tiket Anda</span>
                </h3>
                
                <div class="flex gap-2">
                    <input wire:model="ticketSearch" wire:keydown.enter="checkTicket" class="flex-1 px-3 py-2 bg-surface rounded-lg border border-border-default text-xs font-mono" placeholder="Masukkan ID Tiket (mis: TK-8921)">
                    <button wire:click="checkTicket" class="px-4 py-2 bg-secondary text-on-secondary rounded-lg text-xs font-bold hover:bg-secondary-container hover:text-on-secondary-container transition-colors">
                        Cek
                    </button>
                </div>

                @if($searchResult)
                    <div class="p-4 bg-surface rounded-xl border border-primary/20 text-xs space-y-2 animate-fade-in">
                        <div class="flex justify-between items-center font-bold">
                            <span class="text-primary">{{ $searchResult['ticket_id'] }}</span>
                            <span class="text-status-hadir">{{ $searchResult['status'] }}</span>
                        </div>
                        <p class="text-on-surface-variant">{{ $searchResult['note'] }}</p>
                        <p class="text-[11px] text-outline">Ditangani oleh: {{ $searchResult['technician'] }} &bull; {{ $searchResult['updated_at'] }}</p>
                    </div>
                @endif
            </div>

            <!-- Live Chat Assistant Widget -->
            <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default overflow-hidden flex flex-col h-72">
                <div class="p-3.5 bg-primary text-on-primary flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">chat</span>
                        <span class="text-xs font-bold">Asisten Virtual IT Support</span>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-status-hadir"></span>
                </div>

                <div class="flex-1 p-3 overflow-y-auto space-y-2.5 bg-surface/30 text-xs">
                    @foreach($chatMessages as $msg)
                        <div class="flex {{ $msg['sender'] === 'user' ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%] rounded-xl p-2.5 {{ $msg['sender'] === 'user' ? 'bg-primary text-on-primary rounded-br-none' : 'bg-surface-container-lowest border border-border-default text-text-main rounded-bl-none shadow-xs' }}">
                                <p>{{ $msg['text'] }}</p>
                                <span class="text-[10px] opacity-70 block text-right mt-1">{{ $msg['time'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <form wire:submit.prevent="sendChat" class="p-2 border-t border-border-default bg-surface flex gap-2">
                    <input wire:model="chatInput" class="flex-1 px-3 py-1.5 bg-surface-container-lowest rounded-lg border border-border-default text-xs outline-none focus:ring-1 focus:ring-primary" placeholder="Ketik pesan konsultasi...">
                    <button type="submit" class="p-1.5 bg-primary text-on-primary rounded-lg hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
