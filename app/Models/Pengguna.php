<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $table = 'penggunas'; // Nama tabel di database

    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'tanggal_dibuat', // Sesuai dengan penamaan kolom di database
    ];

    protected $hidden = [
        'password', // Nama kolom password yang benar
        'remember_token',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime', // Sesuai dengan penamaan kolom di database
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
