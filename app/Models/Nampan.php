<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nampan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'nampan';
    protected $date = ['deleted_at'];
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
