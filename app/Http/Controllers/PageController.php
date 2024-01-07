<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $pages = Page::all();
      return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $store = Page::create($request->all());


      // if ($store->save()) {
      // $request->session()->flash('message.level', 'success');
      // $request->session()->flash('message.content', 'Faqja eshte publikuar me sukses');
      // } else {
      //     $request->session()->flash('message.level', 'danger');
      //     $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
      // }

      return redirect('faqet');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
      // $pages = Page::find($page);

      // return view('pages.show', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
      $pages = Page::find($page->id);

      return view('pages.edit', compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
      $pages = Page::find($request->id);

      $pages->title = $request['title'];
      $pages->content = $request['content'];
      $pages->save();

      // if ($pages->save()) {
      // $request->session()->flash('message.level', 'success');
      // $request->session()->flash('message.content', 'Faqja eshte ndryshuar me sukses');
      // } else {
      //     $request->session()->flash('message.level', 'danger');
      //     $request->session()->flash('message.content', 'Dicka nuk shkoje mirë!');
      // }

      return redirect('faqet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
      $pages = Page::find($page);

      $pages->delete();

      return back();
    }
}
