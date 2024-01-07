<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //show all comments from table comments order but id descending and pagiante only 10
    $comments = Comment::orderBy('id', 'desc')->paginate(10);
    return view('comments.index', compact('comments'));
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
    $store = new Comment;

    // $store->post_id = $post->id;
    $store->user_id = Auth()->id();
    $store->body = $request['body'];

    $store->save();

    // if ($store->save()) {
    // $request->session()->flash('message.level', 'success');
    // $request->session()->flash('message.content', 'Commenti eshte publikuar me sukses');
    // } else {
    //     $request->session()->flash('message.level', 'danger');
    //     $request->session()->flash('message.content', 'Diçka nuk shkojë mirë, keni paraqysh që të shkruani më shumë se 5 karatere');
    // }

    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Comment $comment)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Comment $comment)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Comment $comment)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Comment $comment)
  {
    //delete comment
    $comment = Comment::find($comment);

    $comment->delete();

    return back();
  }
}
