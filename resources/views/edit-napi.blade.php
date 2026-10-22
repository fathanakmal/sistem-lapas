@extends('layouts.app')

@section('title', 'Edit Data Narapidana')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200 mb-8">
    
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded text-sm">
            <p class="font-bold mb-1">Terjadi Kesalahan:</p>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="/update-napi/{{ $napi->id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">📋 Data Identitas Pribadi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">No. Registrasi Instansi</label>
                    <input type="text" name="no_registrasi" value="{{ $napi->no_registrasi }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">NIK (16 Digit)</label>
                    <input type="number" name="nik" value="{{ $napi->nik }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ $napi->nama_lengkap }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ $napi->tempat_lahir }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ $napi->tanggal_lahir }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Laki-laki" {{ $napi->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $napi->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Agama</label>
                    <select name="agama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Islam" {{ $napi->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen Protestan" {{ $napi->agama == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="Kristen Katolik" {{ $napi->agama == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                        <option value="Hindu" {{ $napi->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ $napi->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ $napi->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none resize-none" required>{{ $napi->alamat }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4 mt-6">⚖️ Data Perkara & Penempatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Pasal Tindak Pidana</label>
                    <input type="text" name="pasal_tindak_pidana" value="{{ $napi->pasal_tindak_pidana }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Penempatan Blok & Sel</label>
                    <select name="blok_sel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Blok A - Sel 1" {{ $napi->blok_sel == 'Blok A - Sel 1' ? 'selected' : '' }}>Blok A - Sel 1</option>
                        <option value="Blok A - Sel 2" {{ $napi->blok_sel == 'Blok A - Sel 2' ? 'selected' : '' }}>Blok A - Sel 2</option>
                        <option value="Blok B - Sel 1" {{ $napi->blok_sel == 'Blok B - Sel 1' ? 'selected' : '' }}>Blok B - Sel 1</option>
                        <option value="Blok C - Isolasi" {{ $napi->blok_sel == 'Blok C - Isolasi' ? 'selected' : '' }}>Blok C - Isolasi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ $napi->tanggal_masuk }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Estimasi Tanggal Bebas</label>
                    <input type="date" name="estimasi_bebas" value="{{ $napi->estimasi_bebas }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Status Narapidana</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Aktif" {{ $napi->status == 'Aktif' ? 'selected' : '' }}>Aktif (Masih Ditahan)</option>
                        <option value="Bebas" {{ $napi->status == 'Bebas' ? 'selected' : '' }}>Bebas</option>
                        <option value="Pindah" {{ $napi->status == 'Pindah' ? 'selected' : '' }}>Pindah Lapas</option>
                        <option value="Meninggal" {{ $napi->status == 'Meninggal' ? 'selected' : '' }}>Meninggal Dunia</option>
                    </select>
                </div>
            </div>
            <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Kategori Hukum</label>
                    <select name="kategori_hukum" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Tahanan" {{ $napi->kategori_hukum == 'Tahanan' ? 'selected' : '' }}>Tahanan (Belum Vonis)</option>
                        <option value="Narapidana" {{ $napi->kategori_hukum == 'Narapidana' ? 'selected' : '' }}>Narapidana (Sudah Vonis)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Kewarganegaraan</label>
                    <select name="kewarganegaraan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="WNI" {{ $napi->kewarganegaraan == 'WNI' ? 'selected' : '' }}>WNI (Warga Negara Indonesia)</option>
                        <option value="WNA" {{ $napi->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA (Warga Negara Asing)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Klasifikasi Kejahatan</label>
                    <select name="jenis_kejahatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Narkotika" {{ $napi->jenis_kejahatan == 'Narkotika' ? 'selected' : '' }}>Narkotika</option>
                        <option value="Korupsi" {{ $napi->jenis_kejahatan == 'Korupsi' ? 'selected' : '' }}>Korupsi</option>
                        <option value="Trafficking" {{ $napi->jenis_kejahatan == 'Trafficking' ? 'selected' : '' }}>Trafficking (Perdagangan Orang)</option>
                        <option value="Ilegal Loging" {{ $napi->jenis_kejahatan == 'Ilegal Loging' ? 'selected' : '' }}>Ilegal Loging</option>
                        <option value="Ilegal Fishing" {{ $napi->jenis_kejahatan == 'Ilegal Fishing' ? 'selected' : '' }}>Ilegal Fishing</option>
                        <option value="Teroris" {{ $napi->jenis_kejahatan == 'Teroris' ? 'selected' : '' }}>Teroris</option>
                        <option value="Perlindungan Anak" {{ $napi->jenis_kejahatan == 'Perlindungan Anak' ? 'selected' : '' }}>Perlindungan Anak</option>
                        <option value="Lain-lain" {{ $napi->jenis_kejahatan == 'Lain-lain' ? 'selected' : '' }}>Lain-lain (Pidana Umum Biasa)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Posisi / Status Keberadaan</label>
                    <select name="status_keberadaan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Di Dalam Lapas" {{ $napi->status_keberadaan == 'Di Dalam Lapas' ? 'selected' : '' }}>Di Dalam Lapas</option>
                        <option value="Di RSU" {{ $napi->status_keberadaan == 'Di RSU' ? 'selected' : '' }}>Dirawat di RSU</option>
                        <option value="Di Bon" {{ $napi->status_keberadaan == 'Di Bon' ? 'selected' : '' }}>Di Bon (Pemeriksaan Luar)</option>
                        <option value="Asimilasi/Cuti" {{ $napi->status_keberadaan == 'Asimilasi/Cuti' ? 'selected' : '' }}>Asimilasi / Cuti</option>
                        <option value="Lari" {{ $napi->status_keberadaan == 'Lari' ? 'selected' : '' }}>Lari (DPO)</option>
                    </select>
                </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4 mt-6">🖼️ Perbarui Foto Wajah</h3>
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    @if($napi->foto_wajah)
                        <img src="{{ asset('foto_napi/' . $napi->foto_wajah) }}" alt="Foto Lama" class="h-24 w-24 object-cover rounded-xl border border-gray-300 shadow-sm">
                    @else
                        <div class="h-24 w-24 bg-gray-100 rounded-xl flex flex-col items-center justify-center text-gray-400 border border-gray-300 shadow-sm">
                            <span class="text-xs">Tidak ada</span>
                            <span class="text-xs">foto</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1 text-gray-700">Unggah Foto Baru (Opsional)</label>
                    <input type="file" name="foto_wajah" accept="image/jpeg, image/png, image/jpg" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Abaikan jika tidak ingin mengubah foto. Format: JPG/PNG (Maks 2MB).</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 mt-8">
            <a href="/data-napi" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-yellow-500 text-white rounded-lg font-medium hover:bg-yellow-600 transition-colors shadow-sm">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection