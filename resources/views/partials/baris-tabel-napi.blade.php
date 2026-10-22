@forelse ($semuaNapi as $napi)
<tr class="hover:bg-gray-50 transition-colors">
    <td class="p-3 font-mono text-gray-500">{{ $napi->no_registrasi }}</td>
    
    <td class="p-3 flex justify-center">
        @if($napi->foto_wajah)
            <img src="{{ asset('foto_napi/' . $napi->foto_wajah) }}" alt="Foto" class="h-10 w-10 object-cover rounded-full border border-gray-300 shadow-sm">
        @else
            <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-xs font-bold border border-gray-300 shadow-sm">
                X
            </div>
        @endif
    </td>

    <td class="p-3 font-semibold text-gray-800">
        {{ $napi->nama_lengkap }}
        <div class="text-xs text-gray-400 font-normal">NIK: {{ $napi->nik }}</div> </td>
    <td class="p-3">{{ $napi->blok_sel }}</td>
    <td class="p-3">
        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $napi->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
            {{ $napi->status }}
        </span>
    </td>
    <td class="p-3 flex justify-center space-x-2">
        <a href="/detail-napi/{{ $napi->id }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-sm font-medium flex items-center">
            Detail
        </a>
        
        @if(Auth::user()->role === 'superadmin' || Auth::user()->role === 'supervisor')
            <a href="/edit-napi/{{ $napi->id }}" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 text-sm font-medium flex items-center">Edit</a>
        @endif

        @if(Auth::user()->role === 'superadmin')
            <form action="/hapus-napi/{{ $napi->id }}" method="POST" onsubmit="return confirm('Yakin menghapus data {{ $napi->nama_lengkap }}?');">
                @csrf @method('DELETE')
                <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-sm font-medium flex items-center">Hapus</button>
            </form>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="p-8 text-center text-gray-500 font-medium">Belum ada data narapidana.</td>
</tr>
@endforelse