<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->restrictOnDelete();
            $table->foreignId('mapel_id')->constrained('mapel')->restrictOnDelete();
            $table->foreignId('guru_id')->constrained('guru')->restrictOnDelete();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->unsignedTinyInteger('jam_ke');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();

            // Guru tidak boleh mengajar 2 jadwal pada hari dan jam yang sama
            $table->unique(['guru_id', 'hari', 'jam_ke'], 'jadwal_guru_unique');
            // Kelas tidak boleh punya 2 pelajaran pada hari dan jam yang sama
            $table->unique(['kelas_id', 'hari', 'jam_ke'], 'jadwal_kelas_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
