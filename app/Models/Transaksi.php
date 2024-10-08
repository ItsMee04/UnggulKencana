<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable =
    [
        'id_transaksi',
        'keranjang_id',
        'pelanggan_id',
        'discount',
        'tanggal',
        'total',
        'users',
        'status'
    ];
}
