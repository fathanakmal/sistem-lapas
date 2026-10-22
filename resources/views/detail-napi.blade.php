@extends('layouts.app')

@section('title', 'Detail Profil Narapidana')

@section('content')
<div class="max-w-5xl mx-auto mb-8">
    
    <a href="/data-napi" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 mb-4 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Narapidana
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="bg-gray-900 px-8 py-4 border-b border-gray-800 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg tracking-wide">Dossier / Berkas Narapidana</h3>
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $napi->status == 'Aktif' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                STATUS: {{ strtoupper($napi->status) }}
            </span>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="flex flex-col items-center text-center space-y-4">
                <div class="w-48 h-48 rounded-xl overflow-hidden border-4 border-gray-100 shadow-md bg-gray-50 flex items-center justify-center relative">
                    @if($napi->foto_wajah)
                        <img src="{{ asset('foto_napi/' . $napi->foto_wajah) }}" alt="Foto {{ $napi->nama_lengkap }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-20 h-20 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <div class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center">
                            <span class="text-xs font-bold text-gray-500 bg-white px-2 py-1 rounded">Tanpa Foto</span>
                        </div>
                    @endif
                </div>
                
                <div class="w-full">
                    <h2 class="text-2xl font-black text-gray-800 mb-1">{{ $napi->nama_lengkap }}</h2>
                    <p class="text-sm font-medium text-gray-500">No. Reg: <span class="text-blue-600 font-mono">{{ $napi->no_registrasi }}</span></p>
                </div>
            </div>

            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                
                <div class="col-span-2">
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b pb-2 mb-3">Identitas Pribadi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="block text-gray-500 mb-1">NIK</span>
                            <span class="font-semibold text-gray-800">{{ $napi->nik }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-800">{{ $napi->jenis_kelamin }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Tempat, Tanggal Lahir</span>
                            <span class="font-semibold text-gray-800">
                                {{ $napi->tempat_lahir }}, {{ \Carbon\Carbon::parse($napi->tanggal_lahir)->translatedFormat('d F Y') }}
                                <span class="text-blue-600 font-bold ml-1">({{ \Carbon\Carbon::parse($napi->tanggal_lahir)->age }} Tahun)</span>
                            </span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Agama</span>
                            <span class="font-semibold text-gray-800">{{ $napi->agama }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="block text-gray-500 mb-1">Alamat Domisili</span>
                            <span class="font-semibold text-gray-800 leading-relaxed">{{ $napi->alamat }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-span-2 mt-2">
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b pb-2 mb-3">Data Perkara & Penahanan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div>
                            <span class="block text-gray-500 mb-1">Pasal Tindak Pidana</span>
                            <span class="font-bold text-red-600">{{ $napi->pasal_tindak_pidana }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Penempatan Blok & Sel</span>
                            <span class="font-semibold text-gray-800">{{ $napi->blok_sel }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Tanggal Masuk (Eksekusi)</span>
                            <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($napi->tanggal_masuk)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 mb-1">Estimasi Tanggal Bebas</span>
                            <span class="font-bold text-green-600">{{ \Carbon\Carbon::parse($napi->estimasi_bebas)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mt-6 overflow-hidden">
        <div class="bg-blue-50 px-8 py-4 border-b border-blue-100 flex justify-between items-center">
            <h3 class="text-blue-800 font-bold text-lg">Riwayat Remisi & Potongan Tahanan</h3>
        </div>
        
        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b">
                            <th class="p-3">Tanggal SK</th>
                            <th class="p-3">Jenis Remisi</th>
                            <th class="p-3">Potongan</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($napi->remisis as $remisi)
                        <tr>
                            <td class="p-3 text-gray-500">{{ \Carbon\Carbon::parse($remisi->tanggal_diberikan)->translatedFormat('d M Y') }}</td>
                            <td class="p-3 font-bold text-gray-800">{{ $remisi->jenis_remisi }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold">
                                    - {{ $remisi->besaran_bulan }} Bulan, {{ $remisi->besaran_hari }} Hari
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-400 italic">Belum ada riwayat remisi untuk narapidana ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                <h4 class="font-bold text-gray-700 mb-4 border-b pb-2">➕ Catat Remisi Baru</h4>
                
                @if(Auth::user()->role === 'petugas')
                    <p class="text-xs text-red-500 italic">Anda tidak memiliki akses untuk menambah data remisi.</p>
                @else
                    <form action="/tambah-remisi/{{ $napi->id }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Nama/Jenis Remisi</label>
                            <input type="text" name="jenis_remisi" placeholder="Cth: Remisi Idul Fitri 2026" class="w-full px-3 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Potong (Bulan)</label>
                                <input type="number" name="besaran_bulan" value="0" min="0" class="w-full px-3 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Potong (Hari)</label>
                                <input type="number" name="besaran_hari" value="0" min="0" class="w-full px-3 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-600 mb-1">Tanggal Pemberian SK</label>
                            <input type="date" name="tanggal_diberikan" class="w-full px-3 py-2 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg text-sm transition-colors shadow">
                            💾 Simpan & Potong Masa Tahanan
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    @if($napi->status === 'Aktif')
        @if(Auth::user()->role !== 'petugas')
            <div class="bg-white rounded-2xl shadow-sm border border-red-200 mt-6 overflow-hidden">
                <div class="bg-red-50 px-8 py-4 border-b border-red-100 flex items-center space-x-2">
                    <span class="text-xl">🚨</span>
                    <h3 class="text-red-800 font-bold text-lg">Panel Eksekusi Pembebasan Resmi</h3>
                </div>
                
                <div class="p-8">
                    <p class="text-sm text-gray-600 mb-6">Peringatan: Mengeksekusi form ini akan mengubah status narapidana menjadi <b>BEBAS</b> dan menghapusnya dari hitungan Jurnal Harian Lapas.</p>
                    
                    <form action="/proses-bebas/{{ $napi->id }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end" onsubmit="return confirm('Tindakan ini tidak bisa dibatalkan dengan mudah. Yakin ingin membebaskan narapidana ini?');">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Pembebasan</label>
                            <select name="jenis_pembebasan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-red-500" required>
                                <option value="" disabled selected>Pilih Jenis...</option>
                                <option value="Bebas Murni">Bebas Murni (PB)</option>
                                <option value="Cuti Bersyarat">Cuti Bersyarat (CB)</option>
                                <option value="Pembebasan Bersyarat">Pembebasan Bersyarat (PB)</option>
                                <option value="Asimilasi">Asimilasi Rumah</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Nomor Surat Lepas (SK)</label>
                            <input type="text" name="no_surat_lepas" placeholder="Cth: PAS.2-PK.01..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-red-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Aktual Bebas</label>
                            <input type="date" name="tanggal_aktual_bebas" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-red-500" required>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg text-sm transition-colors shadow">
                                🔓 Proses Pembebasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    @else
        <div class="bg-green-50 rounded-2xl shadow-sm border border-green-200 mt-6 p-6 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-3xl mb-3 border border-green-200">
                ✅
            </div>
            <h3 class="text-xl font-black text-green-800 uppercase tracking-widest">Telah Dibebaskan</h3>
            <p class="text-sm font-medium text-green-700 mt-1">
                Melalui program <b>{{ $napi->jenis_pembebasan }}</b> pada tanggal <b>{{ \Carbon\Carbon::parse($napi->tanggal_aktual_bebas)->translatedFormat('d F Y') }}</b>.
            </p>
            <p class="text-xs text-green-600 mt-2 font-mono bg-green-100 px-3 py-1 rounded">
                No. Surat Lepas: {{ $napi->no_surat_lepas }}
            </p>
        </div>
    @endif


</div>
@endsection