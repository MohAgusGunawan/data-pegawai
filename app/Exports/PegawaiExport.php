<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;

class PegawaiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegawai::all();
    }

     /**
     * Menambahkan heading di file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID', 'NIP', 'Nama Depan', 'Nama Belakang', 'Tanggal Lahir', 'Tanggal Masuk',
            'Jenis Kelamin', 'Alamat', 'Kota', 'Provinsi', 'Kode Pos', 'Nomor Telepon',
            'Email', 'Departemen', 'Jabatan', 'Foto Pegawai'
        ];
    }
}
