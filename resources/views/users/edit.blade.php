@extends('layouts.app')

@section('title', 'Ubah Kredensial Petugas')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-lg font-bold text-gray-800 border-b pb-3 mb-6">⚙️ Modifikasi Otorisasi Akun</h3>

    <form action="/update-pengguna/{{ $user->id }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap Petugas</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email Login</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Ubah Kata Sandi (Kosongkan jika tidak diganti)</label>
            <input type="password" name="password" placeholder="Masukkan password baru jika ingin diganti" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Tingkat Hak Akses (Role)</label>
            <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                <option value="supervisor" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas Biasa</option>
            </select>
        </div>
        <div class="flex justify-end space-x-2 pt-4 border-t">
            <a href="/manajemen-pengguna" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 text-sm">Batal</a>
            <button type="submit" class="px-5 py-2 bg-yellow-500 text-white rounded-lg font-medium hover:bg-yellow-600 text-sm shadow-sm">💾 Perbarui Akun</button>
        </div>
    </form>
</div>
@endsection