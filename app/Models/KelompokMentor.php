<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelompokMentor extends Model
{
    use HasFactory;
    protected $table = 'kelompok_mentor';
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
