<?php

namespace App\Http\Controllers;

use App\Models\Tipi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipiController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $tipet = Tipi::all();

    return response()->json($tipet, 200);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $tipet = Tipi::all();

    return response()->json($tipet, 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $type = $request->all();
    return response()->json($type, 200);
  }

  /**
   * Display the specified resource.
   */
  public function show($name)
  {
    $types = Tipi::where("type", '=', $name)->first();
    Log::alert($types);

    return response()->json($types, 200);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tipi $tipi)
  {
    // $tipi = Tipi::find($id);

    // return view('tipet.edit', compact('tipi'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tipi $tipi)
  {
    //Updating the fields to the database based on the id
    $tipi = Tipi::find($request->id);


    //image
    // TODO: Find an alternative for MediaUploader
    //  if($request->hasFile('featFile')){
    //      $media = MediaUploader::fromSource($request->file('featFile'))
    //          // place the file in a directory relative to the disk root
    //          ->toDirectory('images')
    //          ->upload();
    //      $tipi->syncMedia($media, 'thumbnail');
    //  }

    //image
    // TODO: Find an alternative for MediaUploader
    //   if($request->hasFile('file')){
    //      $media = MediaUploader::fromSource($request->file('file'))
    //          // place the file in a directory relative to the disk root
    //          ->toDirectory('images')
    //          ->upload();
    //      $tipi->syncMedia($media, 'tipiImg');
    //  }

    // if($request->hasFile('file')){
    //     $filename = $request->file->getClientOriginalName();
    //     $filename = $request->file('file')->storeAs('/images', $filename);
    //     $tipi->type_img = $filename;
    // }

    $tipi->type = $request['type'];
    $tipi->name = $request['name'];
    $tipi->shortDescription = $request['shortDescription'];
    $tipi->hyrje = $request['hyrje'];
    $tipi->forcatDobesit = $request['forcatDobesit'];
    $tipi->lidhjet = $request['lidhjet'];
    $tipi->miqesite = $request['miqesite'];
    $tipi->siPrinder = $request['siPrinder'];
    $tipi->profesioni = $request['profesioni'];
    $tipi->vendiPunes = $request['vendiPunes'];
    $tipi->shtese = $request['shtese'];

    $tipi->save();

    //   if ($tipi->save()) {
    //  $request->session()->flash('message.level', 'success');
    //  $request->session()->flash('message.content', 'Tipi eshte ndryshuar me sukses');
    //  } else {
    //      $request->session()->flash('message.level', 'danger');
    //      $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
    //  }


    return redirect('admintipet');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tipi $tipi)
  {
    //
  }
}
