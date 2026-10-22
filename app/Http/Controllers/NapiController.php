<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Napi;
use App\Events\NapiDitambahkan;

class NapiController extends Controller
{
    // Menampilkan halaman form
    public function create()
    {
        return view('tambah-napi');
    }

    // Memproses data yang diinput
   public function store(Request $request) {
        $request->validate([
            'no_registrasi' => 'required|unique:napis',
            'nik' => 'required|numeric|digits:16|unique:napis',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required',
            'alamat' => 'required',
            'pasal_tindak_pidana' => 'required',
            'blok_sel' => 'required',
            'tanggal_masuk' => 'required|date',
            'estimasi_bebas' => 'required|date',
            'foto_wajah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Validasi Kolom Baru
            'kewarganegaraan' => 'required',
            'kategori_hukum' => 'required',
            'jenis_kejahatan' => 'required',
            'status_keberadaan' => 'required',
        ]);

        // 1. Ambil SEMUA input KECUALI foto_wajah
        $dataValid = $request->except('foto_wajah');

        // 2. Jika ada file foto, proses dan buat nama baru
        if ($request->hasFile('foto_wajah')) {
            $file = $request->file('foto_wajah');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan ke folder public/foto_napi
            $file->move(public_path('foto_napi'), $namaFile);
            
            // Masukkan nama file yang benar ke dalam data yang akan disimpan
            $dataValid['foto_wajah'] = $namaFile;
        }

        // 3. Simpan ke database menggunakan $dataValid (BUKAN $request->all())
        Napi::create($dataValid);
        
        return redirect('/data-napi')->with('success', 'Data Narapidana berhasil ditambahkan!');
    }

    // 2. READ: Menampilkan semua data napi
    public function index(Request $request) {
        // 1. Mulai query dasar
        $query = Napi::query();

        // 2. Jika ada permintaan pencarian, filter datanya
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('no_registrasi', 'like', "%{$search}%")
                  ->orWhere('blok_sel', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }

        // 3. Ambil 10 data terbaru
        $semuaNapi = $query->latest()->paginate(10);

        // 4. Jika request datang dari JavaScript (AJAX), kembalikan HANYA baris tabel
        if ($request->ajax()) {
            return view('partials.baris-tabel-napi', compact('semuaNapi'))->render();
        }

        // 5. Jika dibuka biasa, tampilkan halaman penuh
        return view('data-napi', compact('semuaNapi'));
    }

    // Tambahkan di bawah fungsi index atau store
    public function show($id) {
        $napi = Napi::findOrFail($id);
        return view('detail-napi', compact('napi'));
    }


    // 3. UPDATE: Menampilkan form edit
    public function edit($id) {
        $napi = Napi::findOrFail($id);
        return view('edit-napi', compact('napi'));
    }

    public function update(Request $request, $id) {
        // 1. Validasi Data (Termasuk 4 kolom baru)
        $request->validate([
            'no_registrasi' => 'required|unique:napis,no_registrasi,' . $id,
            'nik' => 'required|numeric|digits:16|unique:napis,nik,' . $id,
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required',
            'alamat' => 'required',
            'pasal_tindak_pidana' => 'required',
            'blok_sel' => 'required',
            'tanggal_masuk' => 'required|date',
            'estimasi_bebas' => 'required|date',
            'foto_wajah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Tambahan Validasi Kolom Baru
            'kewarganegaraan' => 'required',
            'kategori_hukum' => 'required',
            'jenis_kejahatan' => 'required',
            'status_keberadaan' => 'required',
        ]);

        // 2. Cari Data Napi yang akan diedit
        $napi = Napi::findOrFail($id);

        // 3. Masukkan Data Lama & Baru
        $napi->no_registrasi = $request->no_registrasi;
        $napi->nik = $request->nik;
        $napi->nama_lengkap = $request->nama_lengkap;
        $napi->tempat_lahir = $request->tempat_lahir;
        $napi->tanggal_lahir = $request->tanggal_lahir;
        $napi->jenis_kelamin = $request->jenis_kelamin;
        $napi->agama = $request->agama;
        $napi->alamat = $request->alamat;
        $napi->pasal_tindak_pidana = $request->pasal_tindak_pidana;
        $napi->blok_sel = $request->blok_sel;
        $napi->tanggal_masuk = $request->tanggal_masuk;
        $napi->estimasi_bebas = $request->estimasi_bebas;
        
        // Memasukkan 4 Data Baru
        $napi->kewarganegaraan = $request->kewarganegaraan;
        $napi->kategori_hukum = $request->kategori_hukum;
        $napi->jenis_kejahatan = $request->jenis_kejahatan;
        $napi->status_keberadaan = $request->status_keberadaan;

        // 4. Proses Jika Ada Foto Baru yang Diunggah
        if ($request->hasFile('foto_wajah')) {
            $napi->foto_wajah = $request->file('foto_wajah')->store('foto_napi', 'public');
        }

        // 5. Simpan Perubahan
        $napi->save();

        return redirect('/data-napi')->with('success', 'Data narapidana berhasil diperbarui secara lengkap!');
    }

    // 4. DELETE: Menghapus data
    public function destroy($id) {
        $napi = Napi::findOrFail($id);
        $napi->delete();
        return redirect('/data-napi')->with('success', 'Data berhasil dihapus!');
    }

    public function dashboard() {
        $totalNapiAktif = Napi::where('status', 'Aktif')->count();
        $kapasitasMaksimal = 100; 
        $napiTerbaru = Napi::latest()->take(5)->get();

        $napiSegeraBebas = Napi::where('status', 'Aktif')
            ->whereBetween('estimasi_bebas', [now(), now()->addDays(30)])
            ->orderBy('estimasi_bebas', 'asc')
            ->get();

        $statistikBlok = Napi::where('status', 'Aktif')
            ->selectRaw('blok_sel, count(*) as total')
            ->groupBy('blok_sel')
            ->orderBy('blok_sel', 'asc')
            ->get();

        $napis = Napi::where('status', 'Aktif')->get();

        // ================= TAMBAHAN BARU =================
        // Ambil data kunjungan khusus untuk hari ini beserta data napi yang dikunjungi
        $kunjunganHariIni = \App\Models\Kunjungan::with('napi')
            ->where('tanggal_kunjungan', now()->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get();

        // Pastikan variabel 'kunjunganHariIni' dimasukkan ke dalam compact
        return view('dashboard', compact('totalNapiAktif', 'kapasitasMaksimal', 'napiTerbaru', 'napiSegeraBebas', 'statistikBlok', 'napis', 'kunjunganHariIni'));
    }

    public function jurnalHarian() {
        // Ambil SEMUA data narapidana yang statusnya 'Aktif'
        // Kita tidak memakai pagination (get) karena kita butuh seluruh data untuk dihitung totalnya
        $napis = Napi::where('status', 'Aktif')->get();
        
        // Ambil tanggal hari ini secara otomatis
        $tanggal = now()->translatedFormat('l, d F Y');

        return view('jurnal-harian', compact('napis', 'tanggal'));
    }

    public function prosesBebas(Request $request, $id) {
        // Keamanan: Hanya Superadmin & Supervisor yang bisa mengeksekusi pembebasan
        if (\Illuminate\Support\Facades\Auth::user()->role === 'petugas') {
            abort(403, 'Anda tidak memiliki wewenang untuk mengeksekusi pembebasan.');
        }

        $request->validate([
            'jenis_pembebasan' => 'required|string',
            'no_surat_lepas' => 'required|string',
            'tanggal_aktual_bebas' => 'required|date',
        ]);

        $napi = Napi::findOrFail($id);
        
        // Ubah Status Menjadi Bebas
        $napi->status = 'Bebas'; 
        
        // Simpan Data Pembebasan
        $napi->jenis_pembebasan = $request->jenis_pembebasan;
        $napi->no_surat_lepas = $request->no_surat_lepas;
        $napi->tanggal_aktual_bebas = $request->tanggal_aktual_bebas;
        
        $napi->save();

        return redirect('/data-napi')->with('success', 'Berhasil! Narapidana telah dibebaskan dan dikeluarkan dari hitungan Jurnal Harian Lapas.');
    }
}
