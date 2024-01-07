<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public function post(): BelongsToMany {
    	// this is a many to many stable it links many categories to many posts
    	return $this->belongsToMany(Post::class, 'category_post');
    }

	/**
	* Get the route key for the model.
	*
	* @return string
	*/
	public function getRouteKeyName()
	{
	    return 'slug';
	}
}
