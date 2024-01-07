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
    $results = auth()->user()->testResults->last();

    Carbon::setLocale('sq');
    // Carbon::setUtf8(true);

    return view('home')->with('results', $results);
  }

  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipet()
    {
        return view('tipet');
    }
 
}
