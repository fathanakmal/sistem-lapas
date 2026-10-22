@extends('layouts.app')

@section('title', 'Formulir Registrasi Narapidana')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded text-sm">
            <p class="font-bold mb-1">Terjadi Kesalahan:</p>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="/simpan-napi" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📋 Data Identitas Pribadi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">No. Registrasi Instansi</label>
                    <input type="text" name="no_registrasi" placeholder="Contoh: REG-2026-001" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                    <input type="number" name="nik" placeholder="16 Digit Angka NIK" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama sesuai KTP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" placeholder="Kota/Kabupaten kelahiran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Agama</label>
                    <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled selected>Pilih Agama...</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" placeholder="Alamat domisili terakhir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none" required></textarea>
                </div>
            </div>
            <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Unggah Foto Wajah (Mugshot)</label>
                    <input type="file" name="foto_wajah" accept="image/jpeg, image/png, image/jpg" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal ukuran: 2MB.</p>
             </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">⚖️ Data Perkara & Penempatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Kategori Hukum</label>
                    <select name="kategori_hukum" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled selected>Pilih Kategori...</option>
                        <option value="Tahanan">Tahanan (Belum Vonis)</option>
                        <option value="Narapidana">Narapidana (Sudah Vonis)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Kewarganegaraan</label>
                    <select name="kewarganegaraan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="WNI" selected>WNI (Warga Negara Indonesia)</option>
                        <option value="WNA">WNA (Warga Negara Asing)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Klasifikasi Kejahatan</label>
                    <select name="jenis_kejahatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled selected>Pilih Klasifikasi...</option>
                        <option value="Narkotika">Narkotika</option>
                        <option value="Korupsi">Korupsi</option>
                        <option value="Trafficking">Trafficking (Perdagangan Orang)</option>
                        <option value="Ilegal Loging">Ilegal Loging</option>
                        <option value="Ilegal Fishing">Ilegal Fishing</option>
                        <option value="Teroris">Teroris</option>
                        <option value="Perlindungan Anak">Perlindungan Anak</option>
                        <option value="Lain-lain">Lain-lain (Pidana Umum Biasa)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Posisi / Status Keberadaan</label>
                    <select name="status_keberadaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Di Dalam Lapas" selected>Di Dalam Lapas</option>
                        <option value="Di RSU">Dirawat di RSU</option>
                        <option value="Di Bon">Di Bon (Pemeriksaan Luar)</option>
                        <option value="Asimilasi/Cuti">Asimilasi / Cuti</option>
                        <option value="Lari">Lari (DPO)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Pasal Tindak Pidana</label>
                    <input type="text" name="pasal_tindak_pidana" placeholder="Contoh: Pasal 362 KUHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Penempatan Blok & Sel</label>
                    <select name="blok_sel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="" disabled selected>Pilih Blok...</option>
                        <option value="Blok A - Sel 1">Blok A - Sel 1</option>
                        <option value="Blok A - Sel 2">Blok A - Sel 2</option>
                        <option value="Blok B - Sel 1">Blok B - Sel 1</option>
                        <option value="Blok C - Isolasi">Blok C - Isolasi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tanggal Masuk (Eksekusi)</label>
                    <input type="date" name="tanggal_masuk" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Estimasi Tanggal Bebas</label>
                    <input type="date" name="estimasi_bebas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <a href="/data-napi" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-sm">
                💾 Simpan Data Napi
            </button>
        </div>
    </form>
</div>
@endsection