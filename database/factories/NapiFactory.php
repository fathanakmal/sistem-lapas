<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class NapiFactory extends Factory
{
    public function definition(): array
    {
        // Membuat tanggal masuk acak (antara 5 tahun lalu sampai 1 bulan lalu)
        $tglMasuk = $this->faker->dateTimeBetween('-5 years', '-1 month');
        
        // Membuat tanggal lahir acak (usia antara 18 sampai 65 tahun)
        $tglLahir = $this->faker->dateTimeBetween('-65 years', '-18 years');
        
        // Estimasi bebas: Tanggal masuk ditambah acak 1 sampai 15 tahun
        $estimasiBebas = (clone $tglMasuk)->modify('+' . rand(1, 15) . ' years');

        return [
            'no_registrasi' => 'REG-' . date('Y') . '-' . $this->faker->unique()->randomNumber(5, true),
            'nik' => $this->faker->unique()->numerify('1207############'), // Format NIK Kepri/Bintan acak
            'nama_lengkap' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $tglLahir->format('Y-m-d'),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->address(),
            'pasal_tindak_pidana' => 'Pasal ' . $this->faker->numberBetween(100, 365) . ' KUHP',
            'blok_sel' => $this->faker->randomElement(['Blok A - Sel 1', 'Blok A - Sel 2', 'Blok B - Sel 1', 'Blok C - Isolasi']),
            'tanggal_masuk' => $tglMasuk->format('Y-m-d'),
            'estimasi_bebas' => $estimasiBebas->format('Y-m-d'),
            'status' => 'Aktif',
            
            // Data Sinkronisasi Jurnal
            // WNI diperbanyak probabilitasnya dibanding WNA
            'kewarganegaraan' => $this->faker->randomElement(['WNI', 'WNI', 'WNI', 'WNI', 'WNA']), 
            'kategori_hukum' => $this->faker->randomElement(['Tahanan', 'Narapidana']),
            'jenis_kejahatan' => $this->faker->randomElement(['Narkotika', 'Korupsi', 'Trafficking', 'Ilegal Loging', 'Ilegal Fishing', 'Teroris', 'Perlindungan Anak', 'Lain-lain']),
            // Mayoritas di dalam Lapas
            'status_keberadaan' => $this->faker->randomElement(['Di Dalam Lapas', 'Di Dalam Lapas', 'Di Dalam Lapas', 'Di Dalam Lapas', 'Di RSU', 'Di Bon', 'Asimilasi/Cuti']),
        ];
    }
}