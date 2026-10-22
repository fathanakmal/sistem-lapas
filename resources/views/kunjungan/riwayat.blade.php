@extends('layouts.app')

@section('title', 'Riwayat Kunjungan')

@section('content')
<div class="max-w-7xl mx-auto mb-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Riwayat Kunjungan</h2>
            <p class="text-sm text-gray-500">Database rekam jejak tamu dan barang bawaan warga binaan.</p>
        </div>
        <div class="flex space-x-3">
            <a href="/loket-kunjungan" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-bold shadow-sm hover:bg-blue-700 transition-colors text-sm flex items-center">
                ➕ Buka Loket Pendaftaran
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
        <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">📋 Daftar Rekam Jejak Kunjungan</h2>
            <span class="bg-purple-100 text-purple-700 text-xs font-black px-3 py-1 rounded-full shadow-sm">
                Total: {{ $kunjungans->count() }} Data
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="p-4 font-semibold w-40">Tanggal</th>
                        <th class="p-4 font-semibold">Data Pengunjung</th>
                        <th class="p-4 font-semibold">Mengunjungi Napi</th>
                        <th class="p-4 font-semibold">📦 Barang Bawaan</th>
                        <th class="p-4 font-semibold w-28 text-center">Status Akhir</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-100 text-sm">
                    @forelse ($kunjungans as $kunjungan)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="p-4 font-semibold text-gray-600">
                            {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->translatedFormat('d M Y') }}
                            <br><span class="text-xs font-mono text-gray-400">{{ $kunjungan->no_antrian }}</span>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-gray-800 text-base">{{ $kunjungan->nama_pengunjung }}</div>
                            <div class="text-xs font-semibold text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded mt-1">{{ $kunjungan->hubungan }}</div>
                        </td>
                        <td class="p-4 font-bold text-blue-700">{{ $kunjungan->napi->nama_lengkap }}</td>
                        <td class="p-4">
                            <span class="text-purple-700 font-bold text-xs bg-purple-50 px-2 py-1 rounded border border-purple-100 inline-block">
                                {{ $kunjungan->barang_bawaan }} 
                                @if($kunjungan->berat_barang > 0)
                                    ({{ $kunjungan->berat_barang }} Kg)
                                @endif
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if($kunjungan->status == 'Selesai')
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">Selesai</span>
                            @elseif($kunjungan->status == 'Batal')
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">Batal</span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">{{ $kunjungan->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada riwayat kunjungan yang tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection