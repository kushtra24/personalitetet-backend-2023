<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = User::all();

    return view('profile', compact('user'));
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
    $user = User::find($id);

    return response()->json($user, 200);
  }

  public function profile()
  {
    $user = auth()->user();
    // Make sure the user has test results
    if ($user->testResults->isNotEmpty()) {
      // Add the latest test result's finaltype as a new attribute
      $user->type = $user->testResults->last()->finaltype;
    }
    return response()->json($user, 200);
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $user = User::find($id);

    return view('profile.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $store = User::find($id);

    $store->gjinia = $request['gjinia'];
    $store->adresa = $request['adresa'];
    $store->shteti = $request['shteti'];
    $store->shkollimi = $request['shkollimi'];
    $store->vendlindja = $request['vendlindja'];
    $store->hobby = $request['hobby'];
    $store->save();

    // if ($store->save()) {
    // $request->session()->flash('message.level', 'success');
    // $request->session()->flash('message.content', 'Faqja eshte publikuar me sukses');
    // } else {
    //     $request->session()->flash('message.level', 'danger');
    //     $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
    // }

    return redirect('profile');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
