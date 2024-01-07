<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content'];


    // public static function slug(){
    //    return static::where('slug', $slug)->first();
    //             return view('pages.page')
    //             ->with('content', $page->content)
    //             ->with('title', $page->title);
    // }

}
