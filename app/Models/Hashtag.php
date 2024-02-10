<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = [
        'hashtag'
    ];

    public function causes(): BelongsToMany
    {
        return $this->belongsToMany(Cause::class);
    }
}
