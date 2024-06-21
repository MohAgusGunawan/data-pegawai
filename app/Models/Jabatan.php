<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'nama_jabatan',
        'gaji',
    ];

    // Relationship dengan Pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }
}
