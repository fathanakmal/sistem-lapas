@extends('layouts.app')

@section('title', 'Manajemen Akun Petugas')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-800">👥 Otentikasi & Daftar Petugas Sistem</h3>
        <a href="/tambah-pengguna" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors text-sm shadow-sm">
            ➕ Tambah Petugas Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm text-gray-600 uppercase tracking-wider">
                    <th class="p-4">Nama Lengkap</th>
                    <th class="p-4">Email Login</th>
                    <th class="p-4">Tingkat Hak Akses (Role)</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($semuaUser as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-4 font-bold text-gray-800">{{ $user->name }}</td>
                    <td class="p-4 font-mono text-gray-600">{{ $user->email }}</td>
                    <td class="p-4">
                        @if($user->role === 'superadmin')
                            <span class="px-3 py-1 rounded-full text-xs font-black bg-red-100 text-red-700 border border-red-200">SUPERADMIN</span>
                        @elseif($user->role === 'supervisor')
                            <span class="px-3 py-1 rounded-full text-xs font-black bg-yellow-100 text-yellow-700 border border-yellow-200">SUPERVISOR</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">PETUGAS BIASA</span>
                        @endif
                    </td>
                    <td class="p-4 flex justify-center space-x-2">
                        <a href="/edit-pengguna/{{ $user->id }}" class="px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded hover:bg-yellow-100 text-xs font-medium">Ubah</a>
                        @if($user->id !== Auth::id())
                        <form action="/hapus-pengguna/{{ $user->id }}" method="POST" onsubmit="return confirm('Yakin ingin mencabut hak akses petugas ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 border border-red-200 rounded hover:bg-red-100 text-xs font-medium">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection