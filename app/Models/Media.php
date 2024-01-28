<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Media extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';


    public function posts(): HasOne
    {
        return $this->hasOne(Post::class);
    }

    use HasFactory;
}
