<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'cause_id'
    ];

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }
}
