<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    public function user(): BelongsTo{
      return $this->belongTo(User::class);
  }

  public function tipi(): BelongsTo
  {
      return $this->belongsTo(Tipi::class, 'finaltype', 'type');
  }
}
