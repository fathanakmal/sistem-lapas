<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loket Kunjungan - SATRIA PAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <div class="max-w-7xl mx-auto px-4 py-8">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">🏛️ Loket Pendaftaran Kunjungan</h1>
                <p class="text-gray-500 mt-1">Kelola antrian pengunjung lapas untuk hari ini.</p>
            </div>
            <div class="flex space-x-3">
                <a href="/riwayat-kunjungan" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-bold shadow hover:bg-blue-700 transition-colors">
                    📚 Lihat Riwayat Kunjungan
                </a>
                <a href="/papan-antrian" target="_blank" class="px-5 py-2 bg-purple-600 text-white rounded-lg font-bold shadow hover:bg-purple-700 transition-colors">
                    📺 Buka Layar TV
                </a>
                <a href="/" class="px-5 py-2 bg-gray-800 text-white rounded-lg font-bold shadow hover:bg-gray-900 transition-colors">
                    ⬅ Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm font-bold text-center text-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm font-bold text-center text-lg">
                @foreach ($errors->all() as $error)
                    ⚠️ {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 h-fit">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">➕ Daftar Tamu Baru</h2>
                <form action="/tambah-antrian" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Warga Binaan (Napi)</label>
                        <select name="napi_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                            <option value="" disabled selected>Ketik/Pilih Nama Napi...</option>
                            @foreach($napis as $napi)
                                <option value="{{ $napi->id }}">{{ $napi->nama_lengkap }} (Blok: {{ $napi->blok_sel }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-4 bg-blue-50/50 border border-blue-100 rounded-lg space-y-3">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">👤 Nama Lengkap Pengunjung</label>
                            <input type="text" name="nama_pengunjung" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Sesuai KTP" required>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">💳 NIK (16 Digit)</label>
                                <input type="number" name="nik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="1234567890123456" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">📱 No. HP</label>
                                <input type="text" name="no_hp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="08..." required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">🏠 Alamat Domisili</label>
                            <textarea name="alamat" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Alamat lengkap pengunjung..." required></textarea>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Hubungan dengan Napi</label>
                        <select name="hubungan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                            <option value="Istri / Suami">Istri / Suami</option>
                            <option value="Orang Tua">Orang Tua</option>
                            <option value="Anak">Anak</option>
                            <option value="Saudara Kandung">Saudara Kandung</option>
                            <option value="Kuasa Hukum / Pengacara">Kuasa Hukum / Pengacara</option>
                            <option value="Teman / Lainnya">Teman / Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg space-y-3">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">📦 Barang Bawaan / Makanan</label>
                            <input type="text" name="barang_bawaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm" placeholder="Cth: Nasi Padang, Pakaian (Opsional)">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">⚖️ Berat Barang (Maks 5 Kg)</label>
                            <input type="number" step="0.1" max="5" name="berat_barang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm" placeholder="Cth: 2.5">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mt-2 transition-colors shadow-lg text-lg">
                        🖨️ Cetak Nomor Antrian
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 relative overflow-hidden">
                
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0" style="opacity: 0.04;">
                    <img src="{{ asset('img/logo-2.png') }}" alt="Watermark Lapas" class="w-[320px] h-auto object-contain">
                </div>

                <div class="p-6 relative z-10">
                    <!-- HEADER TABEL & FILTER TANGGAL -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4 border-b pb-2 gap-4">
                        <h2 class="text-xl font-bold text-gray-800">
                            📋 Antrian: <span class="text-blue-600">{{ date('d M Y', strtotime($tanggalDipilih)) }}</span>
                            @if($tanggalDipilih == date('Y-m-d')) 
                                <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full ml-2">Hari Ini</span>
                            @endif
                        </h2>
                        
                        <!-- Form Filter -->
                        <form action="/loket-kunjungan" method="GET" class="flex items-center space-x-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
                            <label class="text-sm font-bold text-gray-600">📅 Cek Jadwal:</label>
                            <!-- Script onchange akan membuat halaman otomatis me-refresh saat tanggal diubah -->
                            <input type="date" name="tanggal" value="{{ $tanggalDipilih }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 outline-none font-semibold text-gray-700" onchange="this.form.submit()">
                        </form>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider border-b">
                                    <th class="p-3">No. Antrian</th>
                                    <th class="p-3">Pengunjung</th>
                                    <th class="p-3">Mengunjungi</th>
                                    <th class="p-3 text-center">Status</th>
                                    <th class="p-3 text-center">Aksi Panggilan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse($antrianHariIni as $antrian)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="p-3 font-black text-xl text-blue-700">{{ $antrian->no_antrian }}</td>
                                    <td class="p-3">
                                        <span class="font-bold text-gray-800">{{ $antrian->nama_pengunjung }}</span> 
                                        <span class="text-xs text-gray-500 font-bold bg-gray-200 px-2 py-0.5 rounded ml-1">{{ $antrian->hubungan }}</span>
                                        <div class="text-xs text-gray-500 mt-1">NIK: {{ $antrian->nik }}</div>
                                        <div class="text-xs text-gray-500">HP: {{ $antrian->no_hp }}</div>
                                        <div class="text-xs font-bold text-purple-600 mt-1">📦 {{ $antrian->barang_bawaan }} ({{ $antrian->berat_barang }} Kg)</div>
                                    </td>
                                    <td class="p-3 font-semibold text-gray-700">{{ $antrian->napi->nama_lengkap }}</td>
                                    <td class="p-3 text-center">
                                        @if($antrian->status == 'Menunggu')
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">Menunggu</span>
                                        @elseif($antrian->status == 'Dipanggil')
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold animate-pulse">Menghadap</span>
                                        @elseif($antrian->status == 'Selesai')
                                            <span class="px-3 py-1 bg-gray-200 text-gray-600 rounded-full text-xs font-bold">Selesai</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Batal</span>
                                        @endif
                                    </td>
                                    <td class="p-3 flex justify-center space-x-2">
                                        @if($antrian->status == 'Menunggu')
                                            <a href="/update-antrian/{{ $antrian->id }}/Dipanggil" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 font-bold text-xs">🔊 Panggil</a>
                                            <a href="/update-antrian/{{ $antrian->id }}/Batal" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 font-bold text-xs" onclick="return confirm('Batalkan antrian ini?')">✖</a>
                                        @elseif($antrian->status == 'Dipanggil')
                                            <a href="/update-antrian/{{ $antrian->id }}/Selesai" class="px-4 py-1 bg-gray-800 text-white rounded hover:bg-gray-900 font-bold text-xs">✔️ Selesai</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada tamu yang mendaftar hari ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>