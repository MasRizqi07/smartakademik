<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_akademik', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->enum('semester_aktif', ['Ganjil', 'Genap']);
            $table->string('nama_madrasah');
            $table->string('npsn');
            $table->string('nsm');
            $table->string('kepala_sekolah');
            $table->string('nip_kepsek');
            $table->text('alamat_madrasah');
            $table->string('email_madrasah');
            $table->string('telepon_madrasah');
            $table->unsignedTinyInteger('kkm_default');
            $table->unsignedInteger('durasi_jam_kbm'); // menit
            $table->timestamps();
        });

        // Seed 1 baris default single-tenant data
        DB::table('pengaturan_akademik')->insert([
            'tahun_ajaran' => '2026/2027',
            'semester_aktif' => 'Ganjil',
            'nama_madrasah' => 'MAN 4 Jombang',
            'npsn' => '20584123',
            'nsm' => '131135170004',
            'kepala_sekolah' => 'Drs. H. Syamsul Huda, M.Pd.I',
            'nip_kepsek' => '196805121994031003',
            'alamat_madrasah' => 'Jl. Raya Jombang - Babat No. 123, Denanyar, Jombang, Jawa Timur',
            'email_madrasah' => 'info@man4jombang.sch.id',
            'telepon_madrasah' => '(0321) 861234',
            'kkm_default' => 75,
            'durasi_jam_kbm' => 45,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_akademik');
    }
};
