<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable =
    [
        'transaksi_id',
        'id_keranjang',
        'pelanggan_id',
        'diskon',
        'tanggal',
        'total',
        'users_id',
        'status'
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
