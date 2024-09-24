<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pelanggan';
    protected $date = ['deleted_at'];
    protected $fillable =
    [
        'kodepelanggan',
        'nik',
        'nama',
        'alamat',
        'kontak',
        'tanggal',
        'poin',
        'status'
    ];
}
