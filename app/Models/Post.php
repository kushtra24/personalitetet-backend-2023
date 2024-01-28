<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    
    public function getImageAttribute($value)
    {
        return asset("storage/$value");
    }

    public function media(): BelongsTo {
      return $this->BelongsTo(Media::class, 'image_id');      
    }

    public function comments(): HasMany{
    	return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo{
        // a comment belongs to a user use this syntax $post->user->id
        return $this->belongsTo(User::class);
    }


    public function categories(): BelongsToMany{
        // this is a many to many stable it links many categories to many posts
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public static function archives(){
        return static::selectRaw('year(created_at) as year, monthname(created_at) as month, count(*) published')
        ->groupBy('year', 'month')
        ->get();
        // ->toArray();
    }
}
