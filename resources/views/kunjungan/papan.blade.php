<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3"> 
    <title>Papan Antrian - SATRIA PAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 font-sans h-screen overflow-hidden text-white flex flex-col">

    <header class="bg-gray-800 border-b border-gray-700 p-6 flex justify-between items-center shadow-md">
        <div class="flex items-center space-x-4">
            <div class="text-4xl">🏛️</div>
            <div>
                <h1 class="text-2xl font-black tracking-widest text-blue-400 uppercase">SATRIA PAS</h1>
                <p class="text-sm text-gray-400 font-bold tracking-wide">Layanan Antrian Kunjungan Terpadu</p>
            </div>
        </div>
        <div class="text-right">
            <div class="text-3xl font-black text-white">{{ \Carbon\Carbon::parse($hariIni)->translatedFormat('l, d F Y') }}</div>
        </div>
    </header>

    <div class="flex-1 grid grid-cols-3 gap-6 p-6">
        
        <div class="col-span-2 flex flex-col justify-center items-center bg-gray-800 rounded-3xl border border-gray-700 shadow-2xl p-10 text-center relative overflow-hidden">
            @if($sedangDipanggil)
                <div class="absolute top-0 left-0 w-full h-2 bg-green-500 animate-pulse"></div>
                
                <h2 class="text-3xl text-gray-400 font-bold mb-4 uppercase tracking-widest">NOMOR ANTRIAN</h2>
                <div class="text-9xl font-black text-green-400 my-8 drop-shadow-[0_0_15px_rgba(74,222,128,0.5)]">
                    {{ $sedangDipanggil->no_antrian }}
                </div>
                
                <div class="bg-gray-900 rounded-2xl w-full p-6 border border-gray-700 mt-4">
                    <p class="text-xl text-gray-400 mb-2">Nama Pengunjung:</p>
                    <p class="text-4xl font-bold text-white mb-6">{{ $sedangDipanggil->nama_pengunjung }}</p>
                    
                    <div class="border-t border-gray-700 pt-6">
                        <p class="text-lg text-gray-500 mb-1">Silakan Menuju Ruang Kunjungan Untuk Menemui:</p>
                        <p class="text-3xl font-bold text-blue-300">{{ $sedangDipanggil->napi->nama_lengkap }}</p>
                    </div>
                </div>
            @else
                <div class="text-gray-600 flex flex-col items-center">
                    <div class="text-9xl mb-6 opacity-20">☕</div>
                    <h2 class="text-4xl font-bold">Layanan Sedang Kosong</h2>
                    <p class="text-xl mt-4">Silakan mendaftar di loket pendaftaran.</p>
                </div>
            @endif
        </div>

        <div class="bg-gray-800 rounded-3xl border border-gray-700 shadow-2xl flex flex-col overflow-hidden">
            <div class="bg-gray-900 p-6 border-b border-gray-700 text-center">
                <h3 class="text-2xl font-black text-yellow-500 uppercase tracking-widest">Menunggu Giliran</h3>
            </div>
            
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @forelse($menunggu as $tunggu)
                    <div class="bg-gray-700 rounded-xl p-4 flex justify-between items-center border border-gray-600 shadow">
                        <div>
                            <p class="text-3xl font-black text-white">{{ $tunggu->no_antrian }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg text-gray-200">{{ $tunggu->nama_pengunjung }}</p>
                        </div>
                    </div>
                @empty
                    <div class="h-full flex items-center justify-center text-gray-500 text-lg font-bold italic text-center p-6">
                        Tidak ada antrian yang menunggu.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="bg-blue-900 py-3 text-white font-bold text-lg overflow-hidden whitespace-nowrap">
        <div class="inline-block animate-[marquee_20s_linear_infinite]">
            ⚠️ PERHATIAN: Waktu kunjungan dibatasi maksimal 30 menit per keluarga. Dilarang membawa alat komunikasi genggam (HP), senjata tajam, dan obat-obatan terlarang ke dalam ruang besuk. Terima kasih atas kerjasamanya. ⚠️
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }
    </style>
</body>
</html>