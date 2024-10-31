<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class nampanProduk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'nampan_produk';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'nampan_id',
        'produk_id',
        'tanggal',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(produk::class);
    }

    public function nampan(): BelongsTo
    {
        return $this->belongsTo(Nampan::class);
    }
}
