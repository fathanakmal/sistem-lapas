<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel napi
            $table->foreignId('napi_id')->constrained('napis')->onDelete('cascade'); 
            
            $table->string('nama_pengunjung');
            $table->string('hubungan'); // Contoh: Istri, Anak, Kuasa Hukum
            $table->string('no_antrian'); // Contoh: A-001, B-012
            
            // Status alur pergerakan pengunjung
            $table->enum('status', ['Menunggu', 'Dipanggil', 'Selesai', 'Batal'])->default('Menunggu');
            
            $table->string('jam_kunjungan')->nullable();
            $table->date('tanggal_kunjungan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
