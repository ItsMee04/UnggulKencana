<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produk';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'kodeproduk',
        'jenis_id',
        'nampan_id',
        'nama',
        'harga_jual',
        'harga_beli',
        'keterangan',
        'berat',
        'karat',
        'image',
        'status'
    ];
}
