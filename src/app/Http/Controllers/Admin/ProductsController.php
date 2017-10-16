<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::all();
        
        return view('admin.products.index')
        ->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        
        return view('admin.products.create')
        ->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Product::create($request->all());

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::find($id);

        return view('admin.products.show')
        ->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categories = Category::all();
        $product = Product::find($id);
        
        return view('admin.products.edit')
        ->withProduct($product)
        ->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $product = Product::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);
        $product->update($request->all());

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::find($id);
        $product->variations()->delete();
        $product->delete();
        
        return redirect()->route('admin.products.index');
    }

    public function change_highlight($product_id, $variation_id){
        $product = Product::find($product_id);
        if($product->highlight_id == $variation_id)
            $product->highlight_id = null;
        else
            $product->highlight_id = $variation_id;
        $product->update();
        return redirect()->route('admin.products.show', $product_id);
    }
}
