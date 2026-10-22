<?php

namespace App\Http\Controllers;

use App\Models\Napi;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KunjunganController extends Controller
{
    // 1. Tampilan Layar TV / Papan Antrian (Public)
    public function papanAntrian() {
        $hariIni = now()->format('Y-m-d');
        
        // Ambil semua antrian hari ini
        $antrianHariIni = Kunjungan::where('tanggal_kunjungan', $hariIni)
                            ->orderBy('updated_at', 'desc')
                            ->get();
                            
        // Kelompokkan berdasarkan status
        $sedangDipanggil = $antrianHariIni->where('status', 'Dipanggil')->first();
        $menunggu = $antrianHariIni->where('status', 'Menunggu')->sortBy('id');
        $selesai = $antrianHariIni->where('status', 'Selesai');

        return view('kunjungan.papan', compact('sedangDipanggil', 'menunggu', 'selesai', 'hariIni'));
    }

    // 2. Tampilan Loket Pendaftaran (Khusus Petugas)
    public function loket(Request $request)
    {
        // 1. Ambil data napi untuk pilihan di form pendaftaran (sebelah kiri)
        $napis = \App\Models\Napi::orderBy('nama_lengkap', 'asc')->get();

        // 2. Cek apakah petugas memilih tanggal. Jika tidak, gunakan tanggal HARI INI
        $tanggalDipilih = $request->tanggal ?? date('Y-m-d');

        // 3. Ambil data antrian KHUSUS untuk tanggal yang dipilih saja
        $antrianHariIni = \App\Models\Kunjungan::whereDate('tanggal_kunjungan', $tanggalDipilih)
                            ->orderBy('created_at', 'asc') 
                            ->get();

        // 4. Kirim data dan variabel tanggalDipilih ke view
        return view('kunjungan.loket', compact('napis', 'antrianHariIni', 'tanggalDipilih'));
    }

    // 3. Simpan Pendaftaran & Cetak Nomor Otomatis
    public function store(Request $request) {
        $request->validate([
            'napi_id' => 'required',
            'nama_pengunjung' => 'required|string',
            'nik' => 'required|numeric|digits:16', // Wajib 16 angka
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'hubungan' => 'required|string',
            'barang_bawaan' => 'nullable|string',
            'berat_barang' => 'nullable|numeric|max:5',
        ], [
            'berat_barang.max' => 'Berat barang bawaan DITOLAK! Maksimal hanya boleh 5 Kg.',
            'nik.digits' => 'Format NIK salah! NIK KTP wajib berjumlah 16 angka.'
        ]);

        $hariIni = now()->format('Y-m-d');
        
        $kunjunganTerakhir = Kunjungan::where('tanggal_kunjungan', $hariIni)
                                      ->orderBy('id', 'desc')
                                      ->first();
        
        $urutan = $kunjunganTerakhir ? (int) substr($kunjunganTerakhir->no_antrian, 2) + 1 : 1;
        $noAntrianBaru = 'A-' . str_pad($urutan, 3, '0', STR_PAD_LEFT);

        Kunjungan::create([
            'napi_id' => $request->napi_id,
            'nama_pengunjung' => $request->nama_pengunjung,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'hubungan' => $request->hubungan,
            'barang_bawaan' => $request->barang_bawaan ?? 'Tidak ada',
            'berat_barang' => $request->berat_barang ?? 0,
            'no_antrian' => $noAntrianBaru,
            'tanggal_kunjungan' => $hariIni,
            'status' => 'Menunggu'
        ]);

        return back()->with('success', "Berhasil! Nomor Antrian $noAntrianBaru telah dicetak.");
    }

    // 4. Petugas Menekan Tombol "Panggil" atau "Selesai"
    public function updateStatus($id, $status) {
        $kunjungan = Kunjungan::findOrFail($id);
        
        if (in_array($status, ['Dipanggil', 'Selesai', 'Batal'])) {
            $kunjungan->status = $status;
            $kunjungan->save();
        }

        return back()->with('success', "Status antrian {$kunjungan->no_antrian} diubah menjadi $status.");
    }

    // 5. Halaman Riwayat Keseluruhan Kunjungan (Khusus Petugas)
    public function riwayat() {
        // Mengambil semua data kunjungan dari yang paling baru
        $kunjungans = Kunjungan::with('napi')
                        ->orderBy('tanggal_kunjungan', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get(); // Nanti bisa diubah menjadi ->paginate(20) jika data sudah ribuan

        return view('kunjungan.riwayat', compact('kunjungans'));
    }

    // Menampilkan Form Pendaftaran Online
    public function formOnline()
    {
        // Tidak ada lagi pengiriman $napis ke view. Halaman jadi lebih ringan dan aman!
        return view('kunjungan.form-online');
    }

    // Menyimpan Data dari Form Online
    public function simpanOnline(Request $request)
    {
        // 1. Validasi input dari form pengunjung
        $request->validate([
            'nama_napi'         => 'required|string',
            'nama_pengunjung'   => 'required|string',
            'nik'               => 'required|numeric|digits:16',
            'no_hp'             => 'required|string',
            'alamat'            => 'required|string',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jam_kunjungan'     => 'required|string',
            'hubungan'          => 'required|string',
        ]);

        // 2. Cari ID Napi berdasarkan ketikan pengunjung (Fuzzy Search)
        $napi = \App\Models\Napi::where('nama_lengkap', 'LIKE', '%' . $request->nama_napi . '%')->first();

        // Jika nama napi tidak ditemukan di database, kembalikan dengan pesan error
        if (!$napi) {
            return back()->withErrors(['nama_napi' => 'Nama Warga Binaan tidak ditemukan. Pastikan ejaan nama sesuai dengan data Lapas.'])->withInput();
        }

        // 3. Logika penomoran antrian otomatis berdasarkan TANGGAL YANG DIPILIH
        $tanggalDipilih = $request->tanggal_kunjungan;
        $antrianTerakhir = \App\Models\Kunjungan::whereDate('tanggal_kunjungan', $tanggalDipilih)->max('no_antrian');
        
        if ($antrianTerakhir) {
            // Mengambil angka dari nomor antrian terakhir (misal 'A-005' menjadi 5) lalu ditambah 1
            $angka = (int) substr($antrianTerakhir, 2) + 1;
            $no_antrian = 'A-' . str_pad($angka, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada antrian pada tanggal tersebut, mulai dari A-001
            $no_antrian = 'A-001';
        }

        // 4. Simpan seluruh data ke database
        \App\Models\Kunjungan::create([
            'napi_id'           => $napi->id, // Menyimpan ID Napi yang ditemukan dari pencarian sistem
            'nama_pengunjung'   => $request->nama_pengunjung,
            'nik'               => $request->nik,
            'no_hp'             => $request->no_hp,
            'alamat'            => $request->alamat,
            'hubungan'          => $request->hubungan,
            'barang_bawaan'     => $request->barang_bawaan,
            'berat_barang'      => $request->berat_barang,
            'tanggal_kunjungan' => $tanggalDipilih,
            'jam_kunjungan'     => $request->jam_kunjungan,
            'no_antrian'        => $no_antrian,
            'status'            => 'Menunggu',
        ]);

        // 5. Kembalikan ke halaman form dengan pesan sukses dan info jadwal
        return back()->with('sukses', 'Nomor Antrian: ' . $no_antrian . ' | Jadwal: ' . date('d-m-Y', strtotime($tanggalDipilih)) . ' (' . $request->jam_kunjungan . ')');
    }
}