<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Napi extends Model
{

    use HasFactory;

    // Mengizinkan kolom di bawah ini untuk diisi data
    protected $fillable = [
        'no_registrasi',
        'nik',
        'nama_lengkap',
        'tempat_lahir',    // Tambahan baru
        'tanggal_lahir',   // Tambahan baru
        'jenis_kelamin',   // Tambahan baru
        'alamat',          // Tambahan baru
        'agama',           // Tambahan baru
        'foto_wajah',
        'pasal_tindak_pidana',
        'blok_sel',
        'tanggal_masuk',
        'estimasi_bebas',
        'status',
        'kewarganegaraan', 
        'kategori_hukum', 
        'jenis_kejahatan', 
        'status_keberadaan',
        'jenis_pembebasan', 
        'no_surat_lepas', 
        'tanggal_aktual_bebas'
    ];

    public function remisis() {
        return $this->hasMany(Remisi::class)->orderBy('tanggal_diberikan', 'desc');
    }

    // Relasi ke tabel kunjungans
    public function kunjungans() {
        return $this->hasMany(Kunjungan::class)->orderBy('created_at', 'desc');
    }
}