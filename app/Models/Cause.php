<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'hashtags',
        'owner',
        'goal',
    ];

    protected $attributes = [
        'approved' => false
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Returns a link that points to the thumbnail.
     */
    public function getThumbNail()
    {
        if ($this->thumbnail) {
            return url('storage/' . $this->thumbnail);
        } else {
            return "https://www.pixel4k.com/wp-content/uploads/2024/01/sunset-lands-art-4k_1706235364.jpg.webp";
        }
    }

    /**
     * Returns a list with applied hashtags.
     */
    public function getHashTags()
    {
        $hashtags = explode(',', $this->hashtags);
        foreach ($hashtags as $key => $hashtag) {
            $hashtags[$key] = '#' . $hashtag;
        }
        return $hashtags;
    }
}
