@extends('layouts.app')

@section('title', 'Daftar Seluruh Narapidana')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    
    <div class="mb-6 flex justify-between items-center">
        <div class="w-full max-w-md relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text" id="inputPencarian" placeholder="Cari nama, no reg, blok, atau status..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm text-gray-600 uppercase tracking-wider">
                    <th class="p-3 w-32">No. Reg</th>
                    <th class="p-3 text-center w-20">Foto</th>
                    <th class="p-3">Nama Lengkap</th>
                    <th class="p-3 w-32">Blok/Sel</th>
                    <th class="p-3 w-28">Status</th>
                    <th class="p-3 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody id="badanTabel" class="divide-y divide-gray-100 text-sm">
                @include('partials.baris-tabel-napi')
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $semuaNapi->links() }}
    </div>
</div>

<script>
    const inputPencarian = document.getElementById('inputPencarian');
    const badanTabel = document.getElementById('badanTabel');

    inputPencarian.addEventListener('input', function() {
        const kataKunci = this.value;

        // Mengirim request ke URL saat ini dengan tambahan parameter search
        fetch(`/data-napi?search=${kataKunci}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Memberitahu Laravel ini adalah request AJAX
            }
        })
        .then(response => response.text())
        .then(html => {
            // Mengganti isi tabel secara instan dengan data hasil pencarian
            badanTabel.innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection