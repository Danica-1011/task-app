<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; // 👈 add this

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'is_done'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}