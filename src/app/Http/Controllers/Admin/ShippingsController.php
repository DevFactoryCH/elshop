<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Shipping;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $shippings = Shipping::all();

        return view('admin.shippings.index')
        ->withShippings($shippings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.shippings.create');
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
        Shipping::create($request->all());
        
        return redirect()->route('admin.shippings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $shipping = Shipping::find($id);

        return view('admin.shippings.edit')
        ->withShipping($shipping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $shipping_method = Shipping::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);
        $shipping_method->update($request->all());

        return redirect()->route('admin.shippings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Shipping::find($id)->delete();

        return redirect()->route('admin.shippings.index');
    }
}
