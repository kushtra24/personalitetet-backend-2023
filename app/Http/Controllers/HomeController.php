<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

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
    $user =  auth('sanctum')->user();

    $results = $user->testResults->last();

    return response()->json($results, 200);
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
