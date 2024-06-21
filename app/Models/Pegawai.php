<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'tanggal_lahir',
        'tanggal_masuk',
        'jenis_kelamin',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'nomor_telepon',
        'email',
        'id_departemen',
        'id_jabatan',
    ];

    // Relationship dengan Departemen
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }

    // Relationship dengan Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
}
