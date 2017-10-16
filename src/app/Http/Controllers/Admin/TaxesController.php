<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Tax;
use App\Models\Country;
use App\Models\Region;
use App\Models\TaxRule;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $taxes = Tax::all();

        return view('admin.taxes.index')
        ->withTaxes($taxes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $regions = Region::all();
        $countries = Country::all();

        return view('admin.taxes.create')
        ->withRegions($regions)
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
            'rate' => 'required|regex:/^\d*(\.\d{1,10})?$/',
        ]);
        $tax = Tax::create($request->all());

        if ($request->has('countries')){
            foreach ($request->input('countries') as $country) {
                $taxRule = new TaxRule();
                $taxRule->country_id = $country;
                $taxRule->tax_id = $tax->id;
                $taxRule->save();
            }
        }

        if ($request->has('regions')) {
            foreach ($request->input('regions') as $region) {
                $taxRule = new TaxRule();
                $taxRule->region_id = $region;
                $taxRule->tax_id = $tax->id;
                $taxRule->save();
            }
        }

        return redirect()->route('admin.taxes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $regions = Region::all();
        $countries = Country::all();
        $tax = Tax::find($id);

        return view('admin.taxes.edit')
        ->withTax($tax)
        ->withRegions($regions)
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
        $tax = Tax::find($id);
        $this->validate($request, [
            'name' => 'required',
            'rate' => 'required|regex:/^\d*(\.\d{1,10})?$/',
        ]);
        $tax->update($request->all());

        //delete all tax rule linked to the tax
        TaxRule::whereTaxId($tax->id)->delete();
        //attach new tax rule
        if ($request->has('countries')) {
            foreach ($request->countries as $country) {
                $taxRule = new TaxRule();
                $taxRule->country_id = $country;
                $taxRule->tax_id = $tax->id;
                $taxRule->save();
            }
        }
        
        if ($request->has('regions')){
            foreach ($request->regions as $region) {
                $taxRule = new TaxRule();
                $taxRule->region_id = $region;
                $taxRule->tax_id = $tax->id;
                $taxRule->save();
            }
        }

        return redirect()->route('admin.taxes.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        TaxRule::where('tax_id', $id)->delete();
        Tax::find($id)->delete();

        return redirect()->route('admin.taxes.index');
    }
}
