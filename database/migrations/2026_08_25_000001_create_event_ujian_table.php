<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_ujian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['PTS Ganjil', 'PAS Ganjil', 'PTS Genap', 'PAT/AAT', 'Asesmen Madrasah']);
            $table->date('tanggal');
            $table->string('waktu'); // format "07:30 - 09:30", string tunggal — jangan dipecah jadi 2 kolom
            $table->string('ruangan');
            $table->string('pengawas_nama'); // TETAP string, lihat Non-Goals
            $table->unsignedInteger('peserta')->nullable(); // JANGAN rand()
            $table->enum('status', ['Terjadwal', 'Persiapan'])->default('Terjadwal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_ujian');
    }
};
