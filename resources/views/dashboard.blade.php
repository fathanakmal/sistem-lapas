@extends('layouts.app')

@section('title', 'Overview Panel')

@section('content')
<div class="max-w-7xl mx-auto mb-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-2xl font-black text-gray-800">Dashboard Utama</h2>
            <p class="text-sm text-gray-500">Ringkasan operasional dan data warga binaan</p>
        </div>
        
        <div class="flex p-1 bg-gray-200/80 rounded-xl shadow-inner border border-gray-300">
            <button onclick="switchMainTab('operasional')" id="btn-main-operasional" class="px-6 py-2.5 bg-white text-blue-700 rounded-lg shadow-sm font-bold text-sm transition-all flex items-center">
                📈 Pantauan Operasional
            </button>
            <button onclick="switchMainTab('jurnal')" id="btn-main-jurnal" class="px-6 py-2.5 text-gray-600 hover:text-gray-900 font-bold text-sm rounded-lg transition-all flex items-center">
                📊 Jurnal Digital
            </button>
        </div>
    </div>

    <div id="panel-operasional" class="space-y-6 block animate-[fadeIn_0.3s_ease-in-out]">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Napi Aktif</h3>
                    <p class="text-4xl font-black text-blue-600 mt-2">
                        {{ $totalNapiAktif }} <span class="text-base text-gray-400 font-normal">Orang</span>
                    </p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>

            @php
                $persentase = $kapasitasMaksimal > 0 ? ($totalNapiAktif / $kapasitasMaksimal) * 100 : 0;
                $warnaBg = $persentase > 100 ? 'bg-red-50 border-red-200' : ($persentase >= 80 ? 'bg-yellow-50 border-yellow-200' : 'bg-green-50 border-green-200');
                $warnaTeks = $persentase > 100 ? 'text-red-700' : ($persentase >= 80 ? 'text-yellow-700' : 'text-green-700');
                $warnaBar = $persentase > 100 ? 'bg-red-600' : ($persentase >= 80 ? 'bg-yellow-500' : 'bg-green-600');
                $statusKapasitas = $persentase > 100 ? 'Overcapacity!' : ($persentase >= 80 ? 'Waspada' : 'Aman');
            @endphp
            <div class="{{ $warnaBg }} p-6 rounded-xl shadow-sm border flex flex-col justify-between">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-sm font-bold {{ $warnaTeks }} opacity-80 uppercase tracking-wider">Status Kapasitas Hunian</h3>
                        <p class="text-2xl font-black {{ $warnaTeks }} mt-1">{{ $statusKapasitas }}</p>
                    </div>
                    <span class="text-lg font-bold {{ $warnaTeks }}">{{ $totalNapiAktif }} / {{ $kapasitasMaksimal }}</span>
                </div>
                <div class="w-full bg-gray-200 bg-opacity-50 rounded-full h-2 mt-4">
                    <div class="{{ $warnaBar }} h-2 rounded-full transition-all duration-500" style="width: {{ min($persentase, 100) }}%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden">
            <div class="p-4 bg-red-50 border-b border-red-100 flex items-center space-x-2">
                <span class="text-lg">⚠️</span>
                <h2 class="text-sm font-black text-red-800 uppercase tracking-wide">Peringatan: Jadwal Pembebasan Mendatang (Maksimal H-30)</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="p-3 font-semibold w-36">No. Registrasi</th>
                            <th class="p-3 font-semibold">Nama Lengkap</th>
                            <th class="p-3 font-semibold w-32">Blok / Sel</th>
                            <th class="p-3 font-semibold text-center w-36">Sisa Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-100 text-sm">
                        @forelse ($napiSegeraBebas as $napi)
                            @php
                                $sisaHari = ceil(\Carbon\Carbon::parse($napi->estimasi_bebas)->diffInDays(now()));
                                $badgeWarna = $sisaHari <= 7 ? 'bg-red-100 text-red-700 animate-pulse' : 'bg-yellow-100 text-yellow-800';
                            @endphp
                            <tr class="hover:bg-amber-50/50 transition-colors">
                                <td class="p-3 font-mono text-gray-500">{{ $napi->no_registrasi }}</td>
                                <td class="p-3 font-bold text-gray-800">{{ $napi->nama_lengkap }}</td>
                                <td class="p-3 text-gray-600">{{ $napi->blok_sel }}</td>
                                <td class="p-3 flex justify-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-black {{ $badgeWarna }} min-w-[70px] text-center shadow-sm">
                                        H - {{ $sisaHari }} Hari
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-4 text-center text-gray-400 italic">Aman. Tidak ada jadwal bebas dekat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">📊 Distribusi Blok</h2>
                </div>
                <div class="p-4 flex-1 flex flex-col space-y-4">
                    @forelse ($statistikBlok as $blok)
                        @php $persenBlok = $totalNapiAktif > 0 ? ($blok->total / $totalNapiAktif) * 100 : 0; @endphp
                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-gray-700">{{ $blok->blok_sel }}</span>
                                <span class="text-blue-600">{{ $blok->total }} Org</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $persenBlok }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-400 italic py-4 text-sm">Belum ada data.</div>
                    @endforelse
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-bold text-gray-800 uppercase tracking-wide">📋 5 Registrasi Terakhir</h2>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                                <th class="p-3 font-semibold">Nama Lengkap</th>
                                <th class="p-3 font-semibold w-32">Blok</th>
                                <th class="p-3 font-semibold w-24">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 divide-y divide-gray-100 text-sm">
                            @forelse ($napiTerbaru as $napi)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="p-3 font-semibold text-gray-800">{{ $napi->nama_lengkap }}</td>
                                <td class="p-3 text-gray-600">{{ $napi->blok_sel }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-xs font-bold bg-green-100 text-green-700">{{ $napi->status }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="p-4 text-center text-gray-400 italic">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="panel-jurnal" class="hidden animate-[fadeIn_0.3s_ease-in-out]">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-900 px-6 py-4 flex justify-between items-center text-white">
                <div>
                    <h3 class="text-lg font-bold tracking-wide">📊 Jurnal Harian Digital Lapas</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Statistik hunian real-time hari ini</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 bg-blue-600 rounded-full text-xs font-mono font-bold border border-blue-500">
                        Total Isi: {{ $napis->count() }}
                    </span>
                    <a href="/jurnal-harian" target="_blank" class="px-4 py-1.5 bg-white text-gray-900 rounded-lg font-bold hover:bg-gray-200 transition-colors shadow text-xs flex items-center">
                        🖨️ Cetak PDF
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 font-bold border-b border-gray-200">
                                <th class="p-4 w-1/3">Kategori Hukum</th>
                                <th class="p-4 text-center bg-blue-50 text-blue-800">WNI (L)</th>
                                <th class="p-4 text-center bg-blue-50 text-blue-800">WNI (P)</th>
                                <th class="p-4 text-center bg-purple-50 text-purple-800">WNA (L)</th>
                                <th class="p-4 text-center bg-purple-50 text-purple-800">WNA (P)</th>
                                <th class="p-4 text-center bg-gray-800 text-white rounded-tr-xl">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-semibold text-gray-800">TAHANAN (Belum Vonis)</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                                <td class="p-4 text-center font-black bg-gray-100 text-gray-900">{{ $napis->where('kategori_hukum', 'Tahanan')->count() }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-semibold text-gray-800">NARAPIDANA (Sudah Vonis)</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                                <td class="p-4 text-center font-medium">{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                                <td class="p-4 text-center font-black bg-gray-100 text-gray-900">{{ $napis->where('kategori_hukum', 'Narapidana')->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="border border-gray-200 rounded-xl bg-white shadow-sm overflow-hidden">
                    <div class="flex flex-wrap bg-gray-50 border-b border-gray-200">
                        <button onclick="switchTab('kejahatan')" id="btn-kejahatan" class="flex-1 py-3 px-4 font-bold text-blue-700 bg-white border-b-2 border-blue-600 focus:outline-none transition-colors">⚠️ Jenis Kejahatan</button>
                        <button onclick="switchTab('agama')" id="btn-agama" class="flex-1 py-3 px-4 font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition-colors border-b-2 border-transparent">🕌 Agama</button>
                        <button onclick="switchTab('status')" id="btn-status" class="flex-1 py-3 px-4 font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition-colors border-b-2 border-transparent">📍 Posisi Fisik</button>
                    </div>

                    <div id="tab-kejahatan" class="block p-2">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-100">
                                @foreach(['Narkotika', 'Korupsi', 'Trafficking', 'Ilegal Loging', 'Ilegal Fishing', 'Teroris', 'Perlindungan Anak', 'Lain-lain'] as $k)
                                <tr class="hover:bg-blue-50/50">
                                    <td class="p-3 pl-6 font-medium text-gray-700">{{ $k }}</td>
                                    <td class="p-3 text-right pr-6 font-bold text-blue-600">{{ $napis->where('jenis_kejahatan', $k)->count() }} Org</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="tab-agama" class="hidden p-2">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-100">
                                @foreach(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $a)
                                <tr class="hover:bg-green-50/50">
                                    <td class="p-3 pl-6 font-medium text-gray-700">{{ $a }}</td>
                                    <td class="p-3 text-right pr-6 font-bold text-green-600">{{ $napis->where('agama', $a)->count() }} Org</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="tab-status" class="hidden p-2">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-100">
                                @foreach(['Di Dalam Lapas', 'Di RSU', 'Di Bon', 'Asimilasi/Cuti', 'Lari'] as $s)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 pl-6 font-medium text-gray-700">{{ $s }}</td>
                                    <td class="p-3 text-right pr-6 font-bold text-gray-900">{{ $napis->where('status_keberadaan', $s)->count() }} Org</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    // FUNGSI 1: Ganti Kamar (Operasional vs Jurnal)
    function switchMainTab(tabName) {
        document.getElementById('panel-operasional').classList.add('hidden');
        document.getElementById('panel-jurnal').classList.add('hidden');
        
        let btnOps = document.getElementById('btn-main-operasional');
        let btnJur = document.getElementById('btn-main-jurnal');
        
        btnOps.className = "px-6 py-2.5 text-gray-600 hover:text-gray-900 font-bold text-sm rounded-lg transition-all flex items-center";
        btnJur.className = "px-6 py-2.5 text-gray-600 hover:text-gray-900 font-bold text-sm rounded-lg transition-all flex items-center";

        document.getElementById('panel-' + tabName).classList.remove('hidden');
        document.getElementById('panel-' + tabName).classList.add('block');
        
        let activeBtn = document.getElementById('btn-main-' + tabName);
        activeBtn.className = "px-6 py-2.5 bg-white text-blue-700 rounded-lg shadow-sm font-bold text-sm transition-all flex items-center";
    }

    // FUNGSI 2: Ganti Sub-Tab di dalam Jurnal (Kejahatan, Agama, Status)
    function switchTab(tabName) {
        document.getElementById('tab-kejahatan').classList.add('hidden');
        document.getElementById('tab-agama').classList.add('hidden');
        document.getElementById('tab-status').classList.add('hidden');
        
        let buttons = ['kejahatan', 'agama', 'status'];
        buttons.forEach(btn => {
            let el = document.getElementById('btn-' + btn);
            el.className = "flex-1 py-3 px-4 font-bold text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition-colors border-b-2 border-transparent";
        });

        document.getElementById('tab-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('block');
        
        let activeBtn = document.getElementById('btn-' + tabName);
        activeBtn.className = "flex-1 py-3 px-4 font-bold text-blue-700 bg-white border-b-2 border-blue-600 focus:outline-none transition-colors";
    }
</script>
@endsection