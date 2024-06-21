<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemens'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'nama_departemen',
        'lokasi',
    ];

    // Relationship dengan Pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_departemen', 'id_departemen');
    }
}
