<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class PegawaiFactory extends Factory
{
    protected $model = Pegawai::class;

    public function definition(): array
    {
        $faker = FakerFactory::create('id_ID');

        $provinsi = [
            'Aceh', 'Bali', 'Banten', 'Bengkulu', 'Gorontalo', 'Jakarta', 'Jambi', 'Jawa Barat', 'Jawa Tengah',
            'Jawa Timur', 'Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah', 'Kalimantan Timur', 'Kalimantan Utara',
            'Kepulauan Bangka Belitung', 'Kepulauan Riau', 'Lampung', 'Maluku', 'Maluku Utara', 'Nusa Tenggara Barat',
            'Nusa Tenggara Timur', 'Papua', 'Papua Barat', 'Riau', 'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tengah',
            'Sulawesi Tenggara', 'Sulawesi Utara', 'Sumatera Barat', 'Sumatera Selatan', 'Sumatera Utara', 'Yogyakarta'
        ];

        $kota = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi', 'Tangerang', 'Depok', 'Semarang', 'Palembang',
            'Makassar', 'Bogor', 'Batam', 'Pekanbaru', 'Banda Aceh', 'Padang', 'Denpasar', 'Samarinda', 'Mataram',
            'Manado', 'Pontianak', 'Banjarmasin', 'Balikpapan', 'Jayapura', 'Ambon', 'Kendari', 'Kupang'
        ];

        $alamat = [
            'Aceh', 'Bali', 'Balikpapan', 'Bandar Lampung', 'Bandung', 'Banjar', 'Banjarbaru', 'Banjarmasin', 'Batam',
            'Batu', 'Bekasi', 'Bengkulu', 'Bima', 'Binjai', 'Bogor', 'Bontang', 'Boyolali', 'Bukittinggi', 'Ciamis',
            'Cianjur', 'Cibinong', 'Cilacap', 'Cilegon', 'Cimahi', 'Cirebon', 'Denpasar', 'Depok', 'Dumai', 'Garut',
            'Gianyar', 'Gorontalo', 'Gresik', 'Indramayu', 'Jakarta', 'Jambi', 'Jayapura', 'Jember', 'Jepara', 'Jombang',
            'Kabanjahe', 'Kediri', 'Kendari', 'Klaten', 'Kudus', 'Kupang', 'Kuta', 'Labuhan Bajo', 'Lamongan', 'Lhokseumawe',
            'Lubuklinggau', 'Madiun', 'Magelang', 'Makassar', 'Malang', 'Manado', 'Martapura', 'Mataram', 'Medan', 'Metro',
            'Mojokerto', 'Padang', 'Padangsidimpuan', 'Palangkaraya', 'Palembang', 'Palopo', 'Palu', 'Pamekasan', 'Pandeglang',
            'Pangkal Pinang', 'Parepare', 'Pariaman', 'Pasuruan', 'Pekalongan', 'Pekanbaru', 'Pematangsiantar', 'Pontianak',
            'Prabumulih', 'Probolinggo', 'Purwakarta', 'Purwokerto', 'Salatiga', 'Samarinda', 'Sampit', 'Sangatta', 'Sidoarjo',
            'Singkawang', 'Situbondo', 'Sorong', 'Sragen', 'Sukabumi', 'Sukoharjo', 'Sumedang', 'Surabaya', 'Surakarta',
            'Tangerang', 'Tanjung Balai', 'Tanjung Pinang', 'Tarakan', 'Tasikmalaya', 'Tegal', 'Ternate', 'Tidore Kepulauan',
            'Tomohon', 'Tual', 'Tuban', 'Tulungagung', 'Ungaran', 'Waingapu', 'Wonogiri', 'Wonosobo', 'Yogyakarta'
        ];
        

        return [
            'foto_pegawai' => $faker->image(storage_path('app/public/images'), 640, 480, null, false),
            'nama_depan' => $this->faker->firstName,
            'nama_belakang' => $this->faker->lastName,
            'tanggal_lahir' => $this->faker->date,
            'tanggal_masuk' => $this->faker->date,
            'jenis_kelamin' => $this->faker->randomElement(['Laki', 'Perempuan']),
            'alamat' => $this->faker->randomElement($alamat),
            'kota' => $this->faker->randomElement($kota),
            'provinsi' => $this->faker->randomElement($provinsi),
            'kode_pos' => $this->faker->postcode,
            'nomor_telepon' => $this->faker->numerify('08##########'),
            'email' => $this->faker->unique()->safeEmail,
            'nip' => $this->faker->unique()->numerify('##########'),
            'id_departemen' => $this->faker->numberBetween(1, 3), 
            'id_jabatan' => $this->faker->numberBetween(1, 3), 
        ];
    }
}
