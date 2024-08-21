<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompok';
    protected $guarded = ['id'];

    public function angkatan(): BelongsTo
    {
        return $this->belongsTo(Angkatan::class, 'angkatan_id');
    }
}
