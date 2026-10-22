<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('napis', function (Blueprint $table) {
            // Kolom ini "nullable" artinya boleh kosong selama napi masih Aktif
            $table->string('jenis_pembebasan')->nullable()->after('status');
            $table->string('no_surat_lepas')->nullable()->after('jenis_pembebasan');
            $table->date('tanggal_aktual_bebas')->nullable()->after('no_surat_lepas');
        });
    }

    public function down(): void
    {
        Schema::table('napis', function (Blueprint $table) {
            $table->dropColumn(['jenis_pembebasan', 'no_surat_lepas', 'tanggal_aktual_bebas']);
        });
    }
};
