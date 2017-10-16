<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Discount;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $discounts = Discount::all();

        return view('admin.discounts.index')
        ->withDiscounts($discounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all(); 
        if ($request->has('start_date')) {
            $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        }
        if ($request->has('end_date')) {
            $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        }

        $this->validate($request, [
            'name' => 'required',
            'products' => 'required',
            'percentage' => 'required_without:new_price',
            'new_price' => 'required_without:percentage'
        ]);
        $discount = Discount::create($data);
        $discount->products()->sync($request->products);
        
        return redirect()->route('admin.discounts.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Discount::find($id)->products()->detach();
        Discount::find($id)->delete();

        return redirect()->route('admin.discounts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        return view('admin.discounts.edit')
        ->withDiscount($discount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $discount = Discount::find($id);
        $data = $request->all(); 
        if($request->input('start_date')) {
            $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        }
        if($request->has('end_date')) {
            $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        }
        $this->validate($request, [
            'name' => 'required',
            'products' => 'required',
            'percentage' => 'required_without:new_price',
            'new_price' => 'required_without:percentage'
        ]);
        $discount->update($data);
        $discount->products()->sync($request->input('products'));

        return redirect()->route('admin.discounts.index');
    }
}
