<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            // Menambahkan kolom barang bawaan dan berat setelah kolom hubungan
            $table->string('barang_bawaan')->nullable()->after('hubungan');
            $table->decimal('berat_barang', 4, 2)->nullable()->after('barang_bawaan');
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn(['barang_bawaan', 'berat_barang']);
        });
    }
};
