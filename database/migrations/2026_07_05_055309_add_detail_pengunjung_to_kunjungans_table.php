<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            // Tambahan detail identitas
            $table->string('nik', 16)->nullable()->after('nama_pengunjung');
            $table->string('no_hp', 20)->nullable()->after('nik');
            $table->text('alamat')->nullable()->after('no_hp');
        });
    }

    public function down(): void
    {
        Schema::table('kunjungans', function (Blueprint $table) {
            $table->dropColumn(['nik', 'no_hp', 'alamat']);
        });
    }
};
