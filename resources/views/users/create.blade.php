@extends('layouts.app')

@section('title', 'Registrasi Akun Petugas Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-6">🔑 Form Kredensial Otorisasi</h3>

    <form action="/simpan-pengguna" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap Petugas</label>
            <input type="text" name="name" placeholder="Nama Lengkap beserta Gelar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Resmi Instansi</label>
            <input type="email" name="email" placeholder="contoh: petugas@lapas.go.id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi Awal (Password)</label>
            <input type="password" name="password" placeholder="Minimal 6 Karakter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Tingkat Hak Akses (Role)</label>
            <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                <option value="" disabled selected>Tentukan Tingkat Wewenang...</option>
                <option value="superadmin">Superadmin (Akses Penuh + Manajemen User)</option>
                <option value="supervisor">Supervisor (Bisa Edit Data Napi, Tidak Bisa Hapus)</option>
                <option value="petugas">Petugas Biasa (Hanya Lihat Data / Read-Only)</option>
            </select>
        </div>
        <div class="flex justify-end space-x-2 pt-4 border-t">
            <a href="/manajemen-pengguna" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 text-sm">Batal</a>
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 text-sm shadow-sm">💾 Buat Akun Petugas</button>
        </div>
    </form>
</div>
@endsection