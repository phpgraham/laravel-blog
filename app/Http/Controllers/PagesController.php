<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::latest()->get();
        //featured page - for now get latest - TODO set in admin
        $featured = $pages->first();
        return view('blog.index')->with(array('featured' => $featured, 'pages' => $pages));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $page)
    {
        //$page = Pages::where('category', $category)->first(); // TODO when added categories
        $pages = Pages::latest()->get();
        return view('blog.view', compact('page'));
    }

}
