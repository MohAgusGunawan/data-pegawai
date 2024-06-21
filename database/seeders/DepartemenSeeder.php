<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departemen::create([
            'nama_departemen' => 'IT',
            'lokasi' => 'Jakarta',
        ]);

        Departemen::create([
            'nama_departemen' => 'HR',
            'lokasi' => 'Surabaya',
        ]);

        Departemen::create([
            'nama_departemen' => 'Marketing',
            'lokasi' => 'Surabaya',
        ]);
    }
}
