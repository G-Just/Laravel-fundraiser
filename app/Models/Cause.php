<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;

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

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
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
    public function getHashTags(): array
    {
        $modelHashtags = $this->hashtags()->get(['hashtag'])->toArray();
        $hashtags = [];
        foreach ($modelHashtags as $key => $value) {
            $hashtags[] = '#' . $modelHashtags[$key]['hashtag'];
        };
        return $hashtags;
    }

    /**
     * Returns a collection with attached images.
     */
    public function getImages(): SupportCollection
    {
        return $this->images()->get()->map(function (object $item) {
            return $item->image = url('storage/' . $item->image);
        });
    }
}
