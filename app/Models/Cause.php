<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'hashtags',
        'goal',
    ];

    protected $attributes = [
        'approved' => false
    ];


    /**
     * Returns a link that points to the thumbnail.
     */
    public function getThumbNail()
    {
        if ($this->thumbnail) {
            return url('storage/' . $this->thumbnail);
        } else {
            return null;
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
