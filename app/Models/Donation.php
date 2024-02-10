<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation',
        'cause_id',
        'user_id'
    ];

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }

    public function donator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
