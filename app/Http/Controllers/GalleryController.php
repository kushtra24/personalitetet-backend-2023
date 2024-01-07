<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $posts = DB::table('media')->get();

      return view('gallery.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //TODO: find an alternative to MediaUploader
      // $media = MediaUploader::fromSource($request->file('file'))
      // place the file in a directory relative to the disk root
      // ->toDirectory('images')
      // ->upload();

      return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $media = Post::find($id);

      return view('gallery.index', compact('media') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      // TODO: find an alternative to Media
      // $post = Media::find($id);

      // $post->delete();

      // return back();
    }
}
