<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remisi extends Model
{
    protected $fillable = ['napi_id', 'jenis_remisi', 'besaran_bulan', 'besaran_hari', 'tanggal_diberikan'];

    public function napi() {
        return $this->belongsTo(Napi::class);
    }
}
