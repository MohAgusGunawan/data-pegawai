<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pekerjaans'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'id_pegawai',
        'id_departemen',
        'id_jabatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    // Relationship dengan Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

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
