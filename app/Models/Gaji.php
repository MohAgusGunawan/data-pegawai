<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gajis'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'id_pegawai',
        'gaji',
        'tanggal_efektif',
    ];

    // Relationship dengan Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
