<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nampan extends Model
{
    use HasFactory;
    protected $table = 'nampan';
    protected $fillable =
    [
        'jenis_id',
        'nampan',
        'tanggal',
        'status'
    ];

    public function jenis(): BelongsTo
    {
        return $this->belongsTo(Jenis::class);
    }
}
