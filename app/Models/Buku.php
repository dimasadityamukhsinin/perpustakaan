<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_rak',
        'id_kategori_buku',
        'judul',
        'penerbit',
        'tahun',
        'isbn',
        'jumlah',
    ];
}