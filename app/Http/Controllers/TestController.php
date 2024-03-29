<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestCounter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
  public $finalType;
  private $finalProcentRez;
  private $nsfinalProcentRez;
  private $ftfinalProcentRez;
  private $rol_name;
  private $introExtro;
  private $intuSens;
  private $feelingThinking;
  private $judgingPerspecting;
  private $FirstfinalProcentRez;
  private $jpfinalProcentRez;


  public function doTheTest()
  {

    $questions = collect();
    $questions = $questions->merge(Question::where('purpose', 'introExtro')->take(11)->inRandomOrder()->get());
    $questions = $questions->merge(Question::where('purpose', 'jundgingPerciving')->take(11)->inRandomOrder()->get());
    $questions = $questions->merge(Question::where('purpose', 'feelingThinking')->take(11)->inRandomOrder()->get());
    $questions = $questions->merge(Question::where('purpose', 'intuitionSensing')->take(11)->inRandomOrder()->get());
    $questions = $questions->shuffle();


    return response()->json($questions, 200);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
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
  public function show(Request $request)
  {
    $user = User::find($request->id);

    return response()->json($user, 200);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Test $test)
  {
    // return view('testi.edit');
  }

  /**
   * Returns the variables and the results to the view
   *
   * @return \Illuminate\Http\Response
   */
  // public function introExtroQuestionsResult()
  // {

  //   $results = Test::latest()->first();

  //   return response()->json($results, 200);

  //   // return view('testi.result', compact('results', 'typeDescription'));
  // }


  public function introExtroQuestions(Request $request)
  {

    // store the final results of the question
    $introExtroResult = 0;
    $intuitionSensingResult = 0;
    $feelingThinkingResult = 0;
    $jundgingPercivingResult = 0;

    // get all questions and evaluate the perpose   
    foreach ($request->all() as $qid => $value) {
      $question = Question::find($qid);
      if ($question->purpose == 'IntroExtro') {
        $introExtroResult += $value;
      } elseif ($question->purpose == 'intuitionSensing') {
        $intuitionSensingResult += $value;
      } elseif ($question->purpose == 'feelingThinking') {
        $feelingThinkingResult += $value;
      } elseif ($question->purpose == 'jundgingPerciving') {
        $jundgingPercivingResult += $value;
      }

      // call_user_func($question->purpose);
    }


    $this->extrovertOrintrovert($introExtroResult);

    $this->intuitiveOrSensing($intuitionSensingResult);

    $this->feelingOrThinking($feelingThinkingResult);

    $this->judgingOrperspecting($jundgingPercivingResult);

    $this->finalTypeName($this->introExtro, $this->intuSens, $this->feelingThinking, $this->judgingPerspecting);

    $test = new Test();

    // TODO: check for user auth
    // if (Auth::check()) {
    //   $test->user_id = Auth::user()->id;
    // }

    $test->finaltype = $this->finalType;
    $test->intro_extro = $this->introExtro;
    $test->first_final_procent_rez = $this->FirstfinalProcentRez;
    $test->intu_sens = $this->intuSens;
    $test->ns_final_procent_rez = $this->nsfinalProcentRez;
    $test->feeling_thinking = $this->feelingThinking;
    $test->ft_final_procent_rez = $this->ftfinalProcentRez;
    $test->judging_perspecting = $this->judgingPerspecting;
    $test->jp_final_procent_rez = $this->jpfinalProcentRez;
    $test->rol_name = $this->rol_name;
    $test->save();

    // if (!Auth::check()){
    // Cookie::queue(Cookie::make('test_id', $test->id, 3000));
    // Cookie::queue(Cookie::make('finaltype', $this->finalType, 3000));
    // Cookie::queue(Cookie::make('introExtro', $this->introExtro, 3000));
    // Cookie::queue(Cookie::make('FirstfinalProcentRez', $this->FirstfinalProcentRez, 3000));
    // Cookie::queue(Cookie::make('intuSens', $this->intuSens, 3000));
    // Cookie::queue(Cookie::make('nsfinalProcentRez', $this->nsfinalProcentRez, 3000));
    // Cookie::queue(Cookie::make('feelingThinking', $this->feelingThinking, 3000));
    // Cookie::queue(Cookie::make('ftfinalProcentRez', $this->ftfinalProcentRez, 3000));
    // Cookie::queue(Cookie::make('judgingPerspecting', $this->judgingPerspecting, 3000));
    // Cookie::queue(Cookie::make('jpfinalProcentRez', $this->jpfinalProcentRez, 3000));
    // Cookie::queue(Cookie::make('rol_name', $this->rol_name, 3000));
    // }

    // increment the test Counter by one
    DB::table('test_counters')->increment('test_counter');

    // Save the answers to the answeres table on the database
    foreach (request()->input('q') as $qid => $value) {
      $answer = new Answer();
      $answer->question_id = $qid;
      $answer->value = $value;
      $answer->testee = TestCounter::first()->test_counter;;
      $answer->save();
    }

    // return $this->introExtroQuestionsResult();
    return redirect('result');
  } //end of function


  //Evaluates the section of extrovert or introvert, working with the partial introExtro.blade.php testi > partials
  public function extrovertOrintrovert($result)
  {


    if ($result < 0) {
      $this->introExtro = "Extrovert";
    } elseif ($result === 0) {
      $this->introExtro = "Extrovert";
    } else {

      $this->introExtro = "Introvert";
    }

    $this->evaluate($result);

    $this->FirstfinalProcentRez = $this->finalProcentRez;

    //    $this->endresult = $this->finalProcentRez . "% " . $this->introExtro;

  }


//Evaluates the section of intuitive or Sensing, working with the partial intuitiveSensing.blade.php testi > partials
public function intuitiveOrSensing($result){
    
  if ($result < 0) {
      $this->intuSens = "Shqisor";
  }
  elseif ($result === 0) {
      $this->intuSens = "Shqisor";
  }
  else{
      $this->intuSens = "Intuitive";
  }

  $this->evaluate($result);

  $this->nsfinalProcentRez = $this->finalProcentRez;

  return  $this->nsfinalProcentRez;
//    $this->nsendresult = $this->finalProcentRez . "% " . $this->intuSens;
}

//Evaluates the section of Feeling or Thinking, working with the partial thinkingFeeling.blade.php testi > partials
  public function feelingOrThinking($result){

      if ($result < 0) {
          $this->feelingThinking = "Arsye";
      }
      elseif ($result === 0) {
          $this->feelingThinking = "Arsye";
      }
      else{
          $this->feelingThinking = "Ndjenjë";
      }

      $this->evaluate($result);

      $this->ftfinalProcentRez = $this->finalProcentRez;

      return $this->ftfinalProcentRez;
//        $this->ftendresult = $this->finalProcentRez . "% " . $this->feelingThinking;
  }

//Evaluates the section of Judging or Perspekting, working with the partial judgingPerspecting.blade.php testi > partials
  public function judgingOrperspecting($result){

      if ($result < 0) {
          $this->judgingPerspecting = "Kërkues";
      }
      elseif ($result === 0) {
          $this->judgingPerspecting = "Kërkues";
      }
      else{
          $this->judgingPerspecting = "Gjykues";
      }

      $this->evaluate($result);

      $this->jpfinalProcentRez = $this->finalProcentRez;

      return $this->jpfinalProcentRez;
//        $this->jpendresult = $this->finalProcentRez . "% " . $this->judgingPerspecting;
  }

// Does the logic of the algorithem on how to take on the results and what to do with them [here is where the magic happens]
public function evaluate($result){
  // get the procentage of 30 as maximum result
  $procent = 3.0303 * $result;

  // Round up the double-number to the nearest integer
  $procentRez = round($procent, 0, PHP_ROUND_HALF_UP);

  //convert a negative number into a positive number
  $this->finalProcentRez = abs($procentRez);

  if ($this->finalProcentRez < 50) {
      $this->finalProcentRez += 50;
  }
}

// putting out the final 4 letters of the personality type.
public function finalTypeName($introExtro, $intuSens,  $feelingThinking, $judgingPerspecting){
  if ($introExtro == "Introvert" && $intuSens == "Intuitive" && $feelingThinking == "Arsye" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "INTJ";
      $this->rol_name = "Arkitekti";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Intuitive" && $feelingThinking == "Arsye" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "INTP";
      $this->rol_name ="Racionali";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Intuitive" && $feelingThinking == "Arsye" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ENTJ";
      $this->rol_name ="Komandanti";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Intuitive" && $feelingThinking == "Arsye" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ENTP";
      $this->rol_name ="Debatisti";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Intuitive" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "INFJ";
      $this->rol_name ="Këshilluesi";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Intuitive" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "INFP";
      $this->rol_name ="Ndërmjetësuesi";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Intuitive" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ENFJ";
      $this->rol_name ="Protagonisti";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Intuitive" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ENFP";
      $this->rol_name ="Përkrahesi";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Shqisor" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ISFJ";
      $this->rol_name ="Mbrojtesi";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Shqisor" && $feelingThinking == "Arsye" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ISTJ";
      $this->rol_name ="Inspektori";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Shqisor" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ESTJ";
      $this->rol_name ="Zbatuesi";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Shqisor" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Gjykues"){
      $this->finalType = "ESFJ";
      $this->rol_name ="Ofruesi";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Shqisor" && $feelingThinking == "Arsye" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ISTP";
      $this->rol_name ="I shkathëti";
  }
  elseif ($introExtro == "Introvert" && $intuSens == "Shqisor" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ISFP";
      $this->rol_name ="Aventuristi";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Shqisor" && $feelingThinking == "Arsye" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ESTP";
      $this->rol_name ="Sipërmarresi";
  }
  elseif ($introExtro == "Extrovert" && $intuSens == "Shqisor" && $feelingThinking == "Ndjenjë" && $judgingPerspecting == "Kërkues"){
      $this->finalType = "ESFP";
      $this->rol_name ="Argëtuesi";
  }
  else {
      $this->finalType = "ESTJ";
      $this->rol_name ="Zbatuesi";
  }

}

public function cantAccess(){
  return "Më vjen keq nuk mund të kyqeni në këtë faqe në atë mënyrë";
}
}
