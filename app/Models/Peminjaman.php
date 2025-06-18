<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_buku',
        'jumlah_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class, 'id_user');
    }

    // Tambahkan relasi ke Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
