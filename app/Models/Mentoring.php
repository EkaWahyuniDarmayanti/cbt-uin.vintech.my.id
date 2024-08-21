<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mentoring extends Model
{
    use HasFactory;
    protected $table = 'mentoring';
    protected $guarded = ['id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
}
