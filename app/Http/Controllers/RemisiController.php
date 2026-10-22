<?php

namespace App\Http\Controllers;

use App\Models\Napi;
use App\Models\Remisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RemisiController extends Controller
{
    public function store(Request $request, $napi_id) {
        // Keamanan: Hanya Superadmin & Supervisor yang bisa input remisi
        if (Auth::user()->role === 'petugas') {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'jenis_remisi' => 'required|string',
            'besaran_bulan' => 'required|integer|min:0',
            'besaran_hari' => 'required|integer|min:0',
            'tanggal_diberikan' => 'required|date',
        ]);

        // 1. Simpan Riwayat Remisinya
        Remisi::create([
            'napi_id' => $napi_id,
            'jenis_remisi' => $request->jenis_remisi,
            'besaran_bulan' => $request->besaran_bulan,
            'besaran_hari' => $request->besaran_hari,
            'tanggal_diberikan' => $request->tanggal_diberikan,
        ]);

        // 2. KEAJAIBAN OTOMATIS: Kurangi tanggal estimasi bebas si Napi
        $napi = Napi::findOrFail($napi_id);
        
        $tanggalBebasBaru = Carbon::parse($napi->estimasi_bebas)
                                ->subMonths($request->besaran_bulan)
                                ->subDays($request->besaran_hari);
        
        $napi->estimasi_bebas = $tanggalBebasBaru->format('Y-m-d');
        $napi->save();

        return back()->with('success', 'Remisi berhasil ditambahkan! Estimasi bebas telah diperbarui secara otomatis.');
    }
}