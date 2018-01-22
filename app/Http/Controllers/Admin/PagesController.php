<?php

namespace App\Http\Controllers\Admin;

use App\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $pages = Pages::all();
        $archives = Pages::onlyTrashed()->get();

        return view('admin.pages.index')->with(array('pages' => $pages, 'archives' => $archives));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $page = Pages::create($request->all());

        if (request()->wantsJson()) {
            return response($page, 201);
        }

        session()->flash('status', 'Your page has been created.');
        return redirect(route('admin.pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $page = Pages::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $page = Pages::find($request->id);

        $page->title = $request->title;
        $page->content = $request->content;

        $page->save();

        session()->flash('status', 'Your page has been updated.');
        return redirect(route('admin.pages.index'));
    }

    /**
     * Soft Delete the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pages::find($id)->destroy($id);
        session()->flash('status', 'Page successfully moved to archive.');
        return redirect(route('admin.pages.index'));
    }

    /**
     * Recover Soft Deleted resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Pages::where('id', $id)->restore($id);
        session()->flash('status', 'Page successfully restored.');
        return redirect(route('admin.pages.index'));
    }

    /**
     * Permantely Delete the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function force($id)
    {
        Pages::where('id', $id)->forcedelete();
        session()->flash('status', 'Page successfully deleted.');
        return redirect(route('admin.pages.index'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:10',
        ]);
    }
}
