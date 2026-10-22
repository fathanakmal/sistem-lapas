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
        Schema::create('remisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('napi_id')->constrained('napis')->onDelete('cascade');
            $table->string('jenis_remisi'); // Contoh: Remisi Idul Fitri 2026
            $table->integer('besaran_bulan')->default(0); // Potong berapa bulan
            $table->integer('besaran_hari')->default(0); // Potong berapa hari
            $table->date('tanggal_diberikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remisis');
    }
};
