<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'nama',
        'email',
        'alamat',
        'no_telp',
        'role',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

}
