<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount'
    ];

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class, 'cause');
    }

    public function donator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'donator');
    }
}
