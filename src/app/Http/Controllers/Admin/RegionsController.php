<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Region;
use App\Models\Address;
use App\Models\Country;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $regions = Region::all();
        
        return view('admin.regions.index')
        ->withRegions($regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries = Country::all();

        return view('admin.regions.create')
        ->withCountries($countries);
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
            'country' => 'required',
        ]);
        Region::create($request->all());

        return redirect()->route('admin.regions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $countries = Country::all();
        $region = Region::find($id);

        return view('admin.regions.edit')
        ->withRegion($region)
        ->withCountries($countries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $region = Region::find($id);
        $this->validate($request, [
            'name' => 'required',
            'country' => 'required',
        ]);
        $region->update($request->all());

        return redirect()->route('admin.regions.index');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Region::find($id)->delete();
        
        return redirect()->route('admin.regions.index');
    }
}
