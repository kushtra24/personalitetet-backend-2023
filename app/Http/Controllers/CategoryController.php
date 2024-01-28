<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::all();
    return response()->json($categories, 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $store = new Category;
    $store->name = $request['name'];
    $store->save();

    return response()->json($store, 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $id = $request['id'];
    $store = Category::find($id);
    $store->name = $request['name'];
    $store->save();
    return response()->json($store, 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    Category::where('id', $category)->delete();

    return back();
  }

  /**
   * 
   */
  public function categoryfilter(Category $category)
  {
    $categories = $category->load('post');
    return response()->json($categories, 200);
  }

}
