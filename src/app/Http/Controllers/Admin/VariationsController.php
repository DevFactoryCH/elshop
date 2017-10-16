<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Variation;
use App\Models\Product;
use App\Models\Type;
use App\Models\Picture;
use App\Models\Attribut;

use File;

class VariationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $variations = Variation::all();

        return view('admin.variations.index')
        ->withVariations($variations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $products = Product::all();
        $types = Type::all();

        return view('admin.variations.create')
        ->withProducts($products)
        ->withTypes($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'stock' => 'required|numeric',
            'product' => 'required',
            'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ]);

        $data = $request->all();
        $data['price'] = $request->price * 100;
        $variation = Variation::create($data);

        if ($request->has('types')) {
            $i = 0;
            foreach ($request->types as $type) {
                $name = $request->names[$i];
                $attribut = Attribut::whereTranslation('name', $name)->first();
                if (is_null($attribut)) {
                    $attribut = new Attribut();
                    $attribut->name = $name;
                    $attribut->save();
                }
                $type_variation = new TypeVariation();
                $type_variation->variation_id = $variation->id;
                $type_variation->type_id = $type;
                $type_variation->attribut_id = $attribut->id;
                $type_variation->save();
                $i++;
            }
        }

        return redirect()->route('admin.variations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $variation = Variation::find($id);
        $products = Product::all();
        $types = Type::all();

        return view('admin.variations.edit')
        ->withVariation($variation)
        ->withProducts($products)
        ->withTypes($types);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $variation = Variation::find($id);
        $this->validate($request, [
            'stock' => 'required|numeric',
            'product' => 'required',
            'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        ]);  
        $data = $request->all();
        $data['price'] = $request->price * 100;
        $variation->update($data);

        if ($request->has('types')) {
            $i = 0;
            $variation->types()->detach();
            foreach ($request->types as $type) {
                $name = $request->input('names')[$i];
                $attribut = Attribut::whereTranslation('name', $name)->first();
                if (is_null($attribut)){
                    $attribut = new Attribut();
                    $attribut->name = $name;
                    $attribut->save();
                }
                $type_variation = new TypeVariation();
                $type_variation->variation_id = $variation->id;
                $type_variation->type_id = $type;
                $type_variation->attribut_id = $attribut->id;
                $type_variation->save();
                $i++;
            }
        }

        return redirect()->route('admin.variations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $variation = Variation::find($id);
        $variation->deleteMedia();
        Product::whereHighlightId($id)->update([
            'highlight_id' => NULL
        ]); //unlink higlighted product with this varation
        $variation->delete();

        return redirect()->route('admin.variations.index');
    }
}
