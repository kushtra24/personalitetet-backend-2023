<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

  // /**
  //  * Create a new controller instance.
  //  *
  //  * @return void
  //  */
  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::check()) {
      // User is authenticated
      $user = auth()->user();
      Log::info($user);
      
      $results = $user->testResults?->last();
  
      return response()->json($results, 200);
  } else {
      // User is not authenticated
      return response()->json(['message' => 'User is not authenticated'], 401);
  }

  }

  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipet()
    {
      // return response()->json($type, 200);
    }
 
}
