<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $questions = Question::all();
      return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('questions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $store = new Question;

      $store->question = $request['pyetja'];
      $store->pajtohem = $request['pajtohem'];
      $store->spajtohem = $request['spajtohem'];
      $store->purpose = $request['purpose'];
      $store->save();

      // if ($store->save()) {
      // $request->session()->flash('message.level', 'success');
      // $request->session()->flash('message.content', 'Pyetja eshte publikuar me sukses');
      // } else {
      //     $request->session()->flash('message.level', 'danger');
      //     $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
      // }

      return redirect('pyetjet');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
      $questions = Question::find($question->id);

      return view('questions.show', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
      $questions = Question::find($question->id);

      return view('questions.edit', compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
      $questions = Question::find($request->id);

      $questions->question = $request['pyetja'];
      $questions->pajtohem = $request['pajtohem'];
      $questions->spajtohem = $request['spajtohem'];
      $questions->purpose = $request['purpose'];
      $questions->save();

      // if ($questions->save()) {
      // $request->session()->flash('message.level', 'success');
      // $request->session()->flash('message.content', 'Pyetja eshte publikuar me sukses');
      // } else {
      //     $request->session()->flash('message.level', 'danger');
      //     $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
      // }

      return redirect('pyetjet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
      $questions = Question::find($question->id);

      $questions->delete();

      return back();
    }
}
