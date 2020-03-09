<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'isbn', 'title', 'subtitle', 'published', 'rating', 'description',
        'user_id'
    ];

    public function images() : HasMany {
        return $this->hasMany(Image::class);
    }

    /**
     * book is assigned to user (n : 1)
     */

     public function user() : BelongsTo {
         return $this->belongsTo(User::class);
     }

     public function authors() : BelongsToMany {
         return $this->belongsToMany(Author::class)->withTimestamps();
     }
}
