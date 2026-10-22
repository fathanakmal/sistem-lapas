<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'napi_id', 'nama_pengunjung', 'nik', 'no_hp', 'alamat', // <-- Tambahan
        'hubungan', 'barang_bawaan', 'berat_barang', 
        'no_antrian', 'status', 'tanggal_kunjungan','jam_kunjungan'
    ];
    // Relasi balik ke Napi
    public function napi() {
        return $this->belongsTo(Napi::class);
    }
}