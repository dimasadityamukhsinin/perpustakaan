<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_peminjaman',
        'jumlah_pengembalian',
        'tanggal_dikembalikan',
        'kondisi_buku',
        'denda',
    ];

    // Relasi ke Peminjaman (optional relasi biar clean)
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}
