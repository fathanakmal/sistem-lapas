<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kunjungan Online - SATRIA PAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex items-center justify-center py-10 px-4 relative">

    <!-- Watermark Logo -->
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0" style="opacity: 0.04;">
        <img src="{{ asset('img/logo-2.png') }}" alt="Watermark Lapas" class="w-[300px] md:w-[500px] h-auto object-contain">
    </div>

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl border border-gray-100 relative z-10 overflow-hidden">
        <!-- Header Form -->
        <div class="bg-blue-700 p-6 text-center text-white">
            <h1 class="text-2xl font-extrabold tracking-wide">SATRIA PAS</h1>
            <p class="text-blue-100 mt-1">Pendaftaran Kunjungan Lapas Online</p>
        </div>

        <div class="p-8">
            <!-- Alert Sukses -->
            @if(session('sukses'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-4 rounded-xl mb-6 text-center shadow-sm">
                    <p class="font-bold text-lg mb-1">🎉 Pendaftaran Berhasil!</p>
                    <p class="font-semibold">{{ session('sukses') }}</p>
                    <p class="text-sm mt-2 text-green-700">Silakan <b>Screenshot</b> halaman ini dan tunjukkan kepada petugas loket saat jadwal kunjungan Anda.</p>
                </div>
            @endif

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                    <ul class="list-disc list-inside text-sm font-semibold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/daftar-jenguk/simpan" method="POST" class="space-y-5">
                @csrf
                
                <!-- Pilih Waktu Kunjungan (Tanggal & Jam) -->
                <div class="bg-purple-50 p-5 rounded-xl border border-purple-100 space-y-4 shadow-sm">
                    <div>
                        <label class="block text-sm font-bold text-purple-900 mb-1">📅 Pilih Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_kunjungan') }}" class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none font-semibold text-gray-700 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-purple-900 mb-1">⏰ Pilih Sesi Waktu (Jam Kunjungan)</label>
                        <select name="jam_kunjungan" class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none font-semibold text-gray-700 shadow-sm" required>
                            <option value="" disabled {{ old('jam_kunjungan') ? '' : 'selected' }}>Pilih Sesi Kedatangan...</option>
                            <option value="Sesi Pagi (09:00 - 11:30 WIB)" {{ old('jam_kunjungan') == 'Sesi Pagi (09:00 - 11:30 WIB)' ? 'selected' : '' }}>Sesi Pagi (09:00 - 11:30 WIB)</option>
                            <option value="Sesi Siang (13:30 - 15:00 WIB)" {{ old('jam_kunjungan') == 'Sesi Siang (13:30 - 15:00 WIB)' ? 'selected' : '' }}>Sesi Siang (13:30 - 15:00 WIB)</option>
                        </select>
                        <p class="text-xs text-purple-600 mt-1 font-medium">*Harap datang tepat waktu sesuai sesi yang Anda pilih</p>
                    </div>
                </div>

                <!-- Input Nama Napi Manual -->
                <div class="pt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Cari Warga Binaan (Napi) yang Dituju</label>
                    <input type="text" name="nama_napi" value="{{ old('nama_napi') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" placeholder="Ketik nama lengkap Warga Binaan..." required>
                    <p class="text-xs text-gray-500 mt-1 font-medium">*Ketik nama dengan benar agar sistem dapat mencocokkan data</p>
                </div>

                <!-- Identitas Pengunjung -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">👤 Nama Lengkap Anda</label>
                        <input type="text" name="nama_pengunjung" value="{{ old('nama_pengunjung') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" placeholder="Sesuai KTP" required>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">💳 NIK (16 Digit)</label>
                            <input type="number" name="nik" value="{{ old('nik') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" placeholder="Masukkan 16 angka NIK" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">📱 Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" placeholder="08..." required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">🏠 Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" placeholder="Alamat domisili saat ini" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Hubungan dengan Napi</label>
                        <select name="hubungan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm" required>
                            <option value="Istri / Suami" {{ old('hubungan') == 'Istri / Suami' ? 'selected' : '' }}>Istri / Suami</option>
                            <option value="Orang Tua" {{ old('hubungan') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                            <option value="Anak" {{ old('hubungan') == 'Anak' ? 'selected' : '' }}>Anak</option>
                            <option value="Saudara Kandung" {{ old('hubungan') == 'Saudara Kandung' ? 'selected' : '' }}>Saudara Kandung</option>
                            <option value="Kuasa Hukum / Pengacara" {{ old('hubungan') == 'Kuasa Hukum / Pengacara' ? 'selected' : '' }}>Kuasa Hukum / Pengacara</option>
                            <option value="Teman / Lainnya" {{ old('hubungan') == 'Teman / Lainnya' ? 'selected' : '' }}>Teman / Lainnya</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4 border-gray-200">

                <!-- Barang Bawaan (Opsional) -->
                <div class="space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <p class="text-sm font-bold text-gray-800">📦 Barang Bawaan / Titipan (Opsional)</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Jenis Barang/Makanan</label>
                            <input type="text" name="barang_bawaan" value="{{ old('barang_bawaan') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none shadow-sm text-sm" placeholder="Cth: Pakaian, Makanan">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Perkiraan Berat (Maks 5 Kg)</label>
                            <input type="number" step="0.1" max="5" name="berat_barang" value="{{ old('berat_barang') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-400 outline-none shadow-sm text-sm" placeholder="Cth: 2.5">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition-transform transform hover:scale-[1.02] text-lg">
                    Daftar Antrian Kunjungan
                </button>
            </form>
        </div>
    </div>

</body>
</html>