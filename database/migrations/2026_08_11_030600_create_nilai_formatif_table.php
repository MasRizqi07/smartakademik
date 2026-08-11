<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_formatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->restrictOnDelete();
            $table->foreignId('mapel_id')->constrained('mapel')->restrictOnDelete();
            $table->enum('jenis', ['tugas', 'ulangan_harian']);
            $table->decimal('nilai', 5, 2); // max 100.00
            $table->date('tanggal');
            $table->foreignId('guru_id')->constrained('guru')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_formatif');
    }
};
