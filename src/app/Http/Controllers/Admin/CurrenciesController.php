<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Currency;
use DB;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currencies = Currency::all();
     
        return view('admin.currencies.index')->withCurrencies($currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.currencies.create');
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
            'countries' => 'required',
            'symbol' => 'required',
            'conversion_rate' => 'required|regex:/^\d*(\.\d{1,10})?$/',
        ]);
        $currency = Currency::create($request->all());
        $currency->countries()->attach($request->input('countries'));
        
        return redirect()->route('admin.currencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $currency = Currency::find($id);

        return view('admin.currencies.edit')
        ->withCurrency($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency = Currency::find($id);
        $this->validate($request, [
            'name' => 'required',
            'countries' => 'required',
            'symbol' => 'required',
            'conversion_rate' => 'required|regex:/^\d*(\.\d{1,10})?$/',
        ]);
        $currency->update($request->all());
        $currency->countries()->sync($request->countries);

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Currency::find($id)->delete();

        return redirect()->route('admin.currencies.index');
    }
    
    /**
     * Set the new default currency
     *
     * @param  int  $currency_id
     * @return 
     */
    public function change_default($id) {
        DB::table('currencies')->update(["default" => FALSE]); //set all to 0
        //set new default to 1
        $currency = Currency::find($id);
        $currency->default = TRUE;
        $currency->update();

        return redirect()->route('admin.currencies.index');
    }
}
