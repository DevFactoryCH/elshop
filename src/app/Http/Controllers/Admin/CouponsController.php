<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Coupon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $coupons = Coupon::all();

        return view('admin.coupons.index')
        ->withCoupons($coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.coupons.create');
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
            'code' => 'required',
            'discount_percent' => 'required_without:discount_price',
            'discount_price' => 'required_without:discount_percent'
        ]);
        $data = $request->all();
        if ($request->has('infinite')) {
            $data['infinite'] = 1;
        }
        else {
            $data['infinite'] = 0;
        }
        Coupon::create($data);
        
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $coupon = Coupon::find($id);
        
        return view('admin.coupons.edit')
        ->with('coupon', $coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $coupon = Coupon::find($id);
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'discount_percent' => 'required_without:discount_price',
            'discount_price' => 'required_without:discount_percent'
        ]);
        $data = $request->all();
        if ($request->has('infinite')) {
            $data['infinite'] = 1;
        }
        else {
            $data['infinite'] = 0;
        }
        $coupon->update($data);

        return redirect()->route('admin.coupons.index');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Coupon::find($id)->delete();
        
        return redirect()->route('admin.coupons.index');
    }
}
