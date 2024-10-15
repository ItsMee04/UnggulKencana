<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function produk(): BelongsTo
    {
        return $this->belongsTo(produk::class);
    }
}
