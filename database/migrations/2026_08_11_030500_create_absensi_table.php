<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->restrictOnDelete();
            $table->foreignId('jadwal_id')->constrained('jadwal_pelajaran')->restrictOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alfa']);
            $table->foreignId('dicatat_oleh')->constrained('users')->restrictOnDelete();
            $table->timestamps();

            // WAJIB: cegah double-input absensi per siswa per jadwal per tanggal
            $table->unique(['siswa_id', 'jadwal_id', 'tanggal'], 'absensi_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
