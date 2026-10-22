<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerbang Masuk - SATRIA PAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen relative overflow-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-2xl relative z-10">
        
        <div class="flex justify-center space-x-4 mb-4">
            <img src="{{ asset('img/logo-1.png') }}" alt="Logo Kemenkumham" class="h-14">
            <img src="{{ asset('img/logo-2.png') }}" alt="Logo Lapas" class="h-14">
        </div>
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-gray-800 tracking-wider">SATRIA <span class="text-blue-600">PAS</span></h1>
            <p class="text-sm font-medium text-gray-500 mt-1">Lapas Kelas IIA Tanjungpinang</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-medium rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Email Petugas</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-shadow" placeholder="admin@lapas.go.id" required autofocus>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi (Password)</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-shadow" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors shadow-lg">
                🔐 Otorisasi Masuk
            </button>
        </form>

        <p class="text-center text-xs text-gray-400 mt-8">
            Hanya untuk penggunaan internal berwenang.<br>Dilindungi oleh hukum.
        </p>
    </div>
</body>
</html>