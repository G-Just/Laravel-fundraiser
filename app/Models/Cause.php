<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;

    // $table->id();
    // $table->string('title');
    // $table->string('description')->nullable();
    // $table->string('thumbnail')->nullable();
    // $table->decimal('goal', $total = 15, $places = 2);
    // $table->timestamps();

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'goal',
    ];

    public function displayThumbnail()
    {
        if ($this->thumbnail) {
            return url('storage/' . $this->thumbnail);
        } else {
            return null;
        }
    }
}
