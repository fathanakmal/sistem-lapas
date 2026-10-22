<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('napis', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->unique();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            
            // --- Kolom Baru Tambahan ---
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('agama')->nullable();
            // ---------------------------

            // --- 4 KOLOM BARU UNTUK SINKRONISASI JURNAL ---
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->default('WNI');
            $table->enum('kategori_hukum', ['Tahanan', 'Narapidana'])->default('Tahanan');
            $table->enum('jenis_kejahatan', ['Narkotika', 'Korupsi', 'Trafficking', 'Ilegal Loging', 'Ilegal Fishing', 'Teroris', 'Perlindungan Anak', 'Lain-lain'])->default('Lain-lain');
            $table->enum('status_keberadaan', ['Di Dalam Lapas', 'Di RSU', 'Di Bon', 'Lari', 'Asimilasi/Cuti'])->default('Di Dalam Lapas');
            // ----------------------------------------------

            $table->string('foto_wajah')->nullable();

            $table->string('pasal_tindak_pidana');
            $table->string('blok_sel');
            $table->date('tanggal_masuk');
            $table->date('estimasi_bebas');
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('napis');
    }
};
