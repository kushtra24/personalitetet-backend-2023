<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name', 'last_name', 'age', 'email', 'password', 'email_token'
  ];


  public function roles(): BelongsToMany
  {
    return $this->belongsToMany('App\Models\Role', 'user_role', 'user_id', 'role_id');
  }

  public function hasAnyRole($roles)
  {
    if (is_array($roles)) {
      foreach ($roles as $role) {
        if ($this->hasRole($role)) {
          return true;
        }
      }
    } else {
      if ($this->hasRole($roles)) {
        return true;
      }
    }
    return false;
  } // end of hasAnyRole

  public function hasRole($role)
  {
    if ($this->roles()->where('name', $role)->first()) {
      return true;
    }
    return false;
  } //end of HasRole

  public function testResults(): HasMany
  {
    return $this->hasMany(Test::class);
  }

  public function post(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  // public function comment()
  // {
  //   return $this->hasMany(Comment::Class);
  // }

  /**
   * Get the comments for the blog post.
   */
  public function comment(): HasMany
  {
    return $this->hasMany(Comment::class);
  }

  public function setageAttribute($value)
  {
    $this->attributes['age'] =  Carbon::parse($value);
  }
}
