<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Napi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNapiAktif = Napi::where('status', 'Aktif')->count();
        $kapasitasMaksimal = 100; // Ubah sesuai kapasitas asli
        
        // Ambil 5 data napi terbaru untuk ditampilkan di tabel
        $napiTerbaru = Napi::latest()->take(5)->get();

        // TAMBAHAN BARU: Ambil SEMUA data napi aktif untuk dihitung di Jurnal Digital
        $napis = Napi::where('status', 'Aktif')->get();

        // Pastikan variabel 'napis' ditambahkan ke dalam compact
        return view('dashboard', compact('totalNapiAktif', 'kapasitasMaksimal', 'napiTerbaru', 'napis'));
    }
}