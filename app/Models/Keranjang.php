<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table  = 'keranjang';
    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'users',
        'total',
        'status'
    ];
}
