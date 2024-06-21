<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create([
            'nama_jabatan' => 'Manager',
            'gaji' => 10000000.00,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff',
            'gaji' => 5000000.00,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Intern',
            'gaji' => 2000000.00,
        ]);
    }
}
