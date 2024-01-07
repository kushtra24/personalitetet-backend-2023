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
    return view('category.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('category.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $store = new Category;

    $store->name = $request['name'];
    // $store->slug = str_slug($store->name, "-");

    $store->save();

    // if ($store->save()) {
    //   $request->session()->flash('message.level', 'success');
    //   $request->session()->flash('message.content', 'Faqja eshte publikuar me sukses');
    // } else {
    //   $request->session()->flash('message.level', 'danger');
    //   $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
    // }

    return redirect('categories');
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    // $category = Category::find($category);

    // return view('category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    $store = Category::find($id);

    $store->name = $request['name'];
    // $store->slug = str_slug($store->name, "-");

    $store->save();

    // if ($store->save()) {
    //   $request->session()->flash('message.level', 'success');
    //   $request->session()->flash('message.content', 'Faqja eshte publikuar me sukses');
    // } else {
    //   $request->session()->flash('message.level', 'danger');
    //   $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
    // }

    return redirect('categories');
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

    return view('post.categoryfilter', compact('categories'));
  }

}
