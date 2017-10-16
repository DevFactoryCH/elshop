<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all();

        return view('admin.categories.index')
        ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        return view('admin.categories.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $data['parent_id'] = $request->input('parent');
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = Category::create($data);
        handleFileUpload('image', $category, $request, 'default');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categories = Category::all();
        $category = Category::find($id);

        return view('admin.categories.edit')
        ->withCategory($category)
        ->withCategories('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $category = Category::find($id);
        $data = $request->all();
        $data['parent_id'] = $request->input('parent');
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category->update($data);
        handleFileUpload('image', $category, $request, 'default');

        return redirect()->route('admin.categories.index');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {      
        $category = Category::find($id);
        $category->deleteMedia();
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
