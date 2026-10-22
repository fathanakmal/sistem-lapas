<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATRIA PAS - Lapas Kelas IIA Tanjungpinang</title>
    <script src="https://cdn.tailwindcss.com"></script>

    
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-lg hidden md:flex shrink-0">
            <div class="h-16 flex items-center justify-center font-black text-2xl border-b border-gray-800 tracking-wider shrink-0">
                SATRIA<span class="text-blue-500 ml-1">PAS</span>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="/" class="block px-4 py-3 rounded-lg font-medium transition-colors {{ request()->is('/') ? 'bg-blue-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    📊 Dashboard
                </a>
                
                <a href="/data-napi" class="block px-4 py-3 rounded-lg font-medium transition-colors {{ request()->is('data-napi') ? 'bg-blue-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    👥 Data Narapidana
                </a>
                
                <a href="/tambah-napi" class="block px-4 py-3 rounded-lg font-medium transition-colors {{ request()->is('tambah-napi') ? 'bg-blue-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    ➕ Tambah Napi Baru
                </a>
                
                <a href="/loket-kunjungan" class="block px-4 py-3 rounded-lg font-medium transition-colors {{ request()->is('loket-kunjungan') ? 'bg-blue-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    🎟️ Loket Kunjungan
                </a>

                @if(Auth::check() && Auth::user()->role === 'superadmin')
                <a href="/manajemen-pengguna" class="block px-4 py-3 rounded-lg font-medium transition-colors {{ request()->is('manajemen-pengguna*') || request()->is('tambah-pengguna*') || request()->is('edit-pengguna*') ? 'bg-blue-600 text-white shadow' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    ⚙️ Manajemen Pengguna
                </a>
                @endif
            </nav>

            <div class="p-4 border-t border-gray-800 bg-gray-900 shrink-0">
                <div class="flex items-center space-x-3 mb-4 px-2">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white shadow-inner">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-xs text-gray-400 truncate uppercase">{{ Auth::user()->role ?? 'Petugas' }}</p> 
                    </div>
                </div>
                
                <form action="/logout" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-red-500/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-500/50 hover:border-red-600 px-4 py-2.5 rounded-lg transition-all text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="bg-white shadow-sm border-b border-gray-200 pt-6 pb-5 flex flex-col items-center justify-center shrink-0">
                <div class="flex justify-center items-center space-x-6 mb-3">
                    <img src="{{ asset('img/logo-1.png') }}" alt="Logo Kemenkumham" class="h-16 w-auto drop-shadow-md">
                    <img src="{{ asset('img/logo-2.png') }}" alt="Logo Lapas" class="h-16 w-auto drop-shadow-md">
                </div>
                <h1 class="text-3xl text-gray-800 font-black tracking-widest mb-1">SATRIA PAS</h1>
                <p class="text-sm text-gray-500 font-medium tracking-wide mb-2 italic text-center px-4">
                    (Sistem Terintegrasi Registrasi dan Informasi Pemasyarakatan)
                </p>
                <h2 class="text-xl text-gray-700 font-extrabold tracking-wide text-center">
                    Lapas Kelas IIA <span class="text-blue-600">Tanjungpinang</span>
                </h2>
            </header>

            <div class="bg-white px-6 py-3 border-b border-gray-200 shrink-0">
                <h2 class="text-md font-semibold text-gray-600">📍 @yield('title')</h2>
            </div>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 relative">
                
                <!-- ================= WATERMARK LOGO DI TENGAH KONTEN ================= -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-[0.03] z-0">
                    <img src="/latar1.png" alt="Watermark Lapas" class="w-[450px] lg:w-[550px] h-auto object-contain">
                </div>
                <!-- =================================================================== -->

                @if (session('success'))
                <div id="toast-success" class="absolute top-6 right-6 flex items-center w-full max-w-xs p-4 mb-4 text-gray-700 bg-white rounded-xl shadow-lg border-l-4 border-green-500 transition-opacity duration-500 z-50">
                    <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
                </div>
                <script>setTimeout(() => { document.getElementById('toast-success').style.display='none'; }, 3000);</script>
                @endif

                <!-- Konten Formulir/Data akan menimpa logo karena z-index mereka lebih tinggi (bawaan browser) -->
                @yield('content')
                
            </main>
        </div>
    </div>

</body> 
</html>