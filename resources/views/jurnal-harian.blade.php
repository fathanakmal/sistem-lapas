<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Harian - SATRIA PAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Desain Kertas A4 & Pengaturan Cetak */
        body { font-family: 'Times New Roman', Times, serif; background-color: #f3f4f6; }
        .kertas-a4 { width: 21cm; min-height: 29.7cm; margin: 2cm auto; background: white; padding: 2cm; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        .text-left { text-align: left; }
        
        @media print {
            body { background-color: white; }
            .kertas-a4 { margin: 0; box-shadow: none; width: 100%; padding: 0; }
            .no-print { display: none !important; }
            @page { margin: 1cm; }
        }
    </style>
</head>
<body>

    <div class="fixed bottom-8 right-8 no-print flex space-x-3">
        <a href="/" class="px-6 py-3 bg-gray-800 text-white font-bold rounded-full shadow-lg hover:bg-gray-700">⬅ Kembali</a>
        <button onclick="window.print()" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-full shadow-lg hover:bg-blue-700">🖨️ Cetak / Simpan PDF</button>
    </div>

    <div class="kertas-a4">
        
        <div class="text-center mb-6 border-b-2 border-black pb-4">
            <h2 class="font-bold text-sm tracking-wide">KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA</h2>
            <h2 class="font-bold text-sm tracking-wide">DIREKTORAT JENDERAL PEMASYARAKATAN</h2>
            <h2 class="font-bold text-sm tracking-wide">KANTOR WILAYAH KEPULAUAN RIAU</h2>
            <h1 class="font-bold text-lg mt-1">LEMBAGA PEMASYARAKATAN KELAS IIA TANJUNGPINANG</h1>
            <p class="text-xs">Jalan DR. Sahardjo, SH No. 01 Kp. Banjar Lama Km. 18 Gn Kijang - Bintan</p>
        </div>

        <div class="text-center font-bold text-lg mb-4 underline">JURNAL HARIAN DAN RINCIAN ISI LAPAS</div>
        
        <div class="flex justify-between mb-4 text-sm font-bold">
            <div>HARI / TANGGAL : {{ strtoupper($tanggal) }}</div>
            <div>TOTAL KAPASITAS : 100 / ISI: {{ $napis->count() }}</div>
        </div>

        <table>
            <tr class="font-bold bg-gray-100">
                <th rowspan="2" class="w-1/3">KATEGORI HUKUM</th>
                <th colspan="2">WNI</th>
                <th colspan="2">WNA</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr class="font-bold bg-gray-50">
                <th>LK</th><th>PR</th>
                <th>LK</th><th>PR</th>
            </tr>
            <tr>
                <td class="text-left font-bold">TAHANAN (Belum Vonis)</td>
                <td>{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Tahanan')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                <td class="font-bold">{{ $napis->where('kategori_hukum', 'Tahanan')->count() }}</td>
            </tr>
            <tr>
                <td class="text-left font-bold">NARAPIDANA (Sudah Vonis)</td>
                <td>{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNI')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                <td>{{ $napis->where('kategori_hukum', 'Narapidana')->where('kewarganegaraan', 'WNA')->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                <td class="font-bold">{{ $napis->where('kategori_hukum', 'Narapidana')->count() }}</td>
            </tr>
        </table>

        <div class="flex space-x-4">
            <table class="w-1/2">
                <tr class="font-bold bg-gray-100">
                    <th class="text-left">JENIS KEJAHATAN</th><th>LK</th><th>PR</th><th>JML</th>
                </tr>
                @php $kejahatan = ['Narkotika', 'Korupsi', 'Trafficking', 'Ilegal Loging', 'Ilegal Fishing', 'Teroris', 'Perlindungan Anak', 'Lain-lain']; @endphp
                @foreach($kejahatan as $k)
                <tr>
                    <td class="text-left">{{ $k }}</td>
                    <td>{{ $napis->where('jenis_kejahatan', $k)->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                    <td>{{ $napis->where('jenis_kejahatan', $k)->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                    <td class="font-bold">{{ $napis->where('jenis_kejahatan', $k)->count() }}</td>
                </tr>
                @endforeach
            </table>

            <table class="w-1/2">
                <tr class="font-bold bg-gray-100">
                    <th class="text-left">AGAMA</th><th>LK</th><th>PR</th><th>JML</th>
                </tr>
                @php $agama = ['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu']; @endphp
                @foreach($agama as $a)
                <tr>
                    <td class="text-left">{{ $a }}</td>
                    <td>{{ $napis->where('agama', $a)->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                    <td>{{ $napis->where('agama', $a)->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                    <td class="font-bold">{{ $napis->where('agama', $a)->count() }}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <table class="w-full mt-2">
            <tr class="font-bold bg-gray-100">
                <th class="text-left">STATUS KEBERADAAN (LAIN-LAIN)</th><th>LK</th><th>PR</th><th>TOTAL</th>
            </tr>
            @php $statusFisik = ['Di Dalam Lapas', 'Di RSU', 'Di Bon', 'Asimilasi/Cuti', 'Lari']; @endphp
            @foreach($statusFisik as $s)
            <tr>
                <td class="text-left">{{ $s }}</td>
                <td>{{ $napis->where('status_keberadaan', $s)->where('jenis_kelamin', 'Laki-laki')->count() }}</td>
                <td>{{ $napis->where('status_keberadaan', $s)->where('jenis_kelamin', 'Perempuan')->count() }}</td>
                <td class="font-bold">{{ $napis->where('status_keberadaan', $s)->count() }}</td>
            </tr>
            @endforeach
        </table>

        <div class="mt-12 flex justify-end">
            <div class="text-center w-64 text-sm">
                <p>Tanjungpinang, {{ now()->translatedFormat('d F Y') }}</p>
                <p class="font-bold mt-1">Petugas Registrasi,</p>
                <br><br><br><br>
                <p class="font-bold underline uppercase">{{ Auth::user()->name }}</p>
            </div>
        </div>

    </div>
</body>
</html>