<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $registerdUsers = User::count();

      $writtenPosts = DB::table('posts')->count();

      $comments = DB::table('comments')->count();

      $countResults = Test::select(DB::raw('count(*) as Numri, finaltype'))
                          ->where('finaltype', '<>', 1)
                          ->groupBy('finaltype')
                          ->get();

      $getTestee = request('testee');
      
      $answers = Answer::with('question')->where('testee', '=', $getTestee)->get();
  
      $questions = Question::withCount([
          'answers as answer_minus_3' => function($query){
          $query->where('value', -3);
      },
          'answers as answer_minus_2' => function($query){
          $query->where('value', -2);
      },
          'answers as answer_minus_1' => function($query){
          $query->where('value', -1);
      },
          'answers as answer_0' => function($query){
          $query->where('value', 0);
      },
          'answers as answer_1' => function($query){
          $query->where('value', 1);
      },
          'answers as answer_2' => function($query){
          $query->where('value', 2);
      },
          'answers as answer_3' => function($query){
          $query->where('value', 3);
      }
      ])->get();

      return view('admin.index', compact('registerdUsers', 'writtenPosts', 'comments', 'countResults', 'questions', 'answers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
