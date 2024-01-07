<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    public function post(): BelongsTo{
    	// a comment belongs to a post use this syntax $comment->post->id
    	return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo{
    	// a comment belongs to a user use this syntax $comment->user->id
    	return $this->belongsTo(User::class);
    }
}
