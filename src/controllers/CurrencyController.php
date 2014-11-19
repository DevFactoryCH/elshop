<?php
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Config;

use Devfactory\Elshop\Models\Currency;

class CurrencyController extends \Devfactory\Elshop\Controllers\ElshopController
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $currencies = Currency::all();

    return View::make('elshop::currencies.index', compact('currencies'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('elshop::brands.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make(Input::All(), Currency::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $brand = new Currency();
    $brand->name = Input::get('name');
    $brand->status = TRUE;
    $brand->save();

    return Redirect::route($this->prefix . 'brands.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $brand = Brand::find($id);

    return View::make('elshop::brands.edit', compact('brand'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $validator = Validator::make(Input::All(), Brand::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $brand = Brand::find($id);
    $brand->name = Input::get('name');
    $brand->save();

    return Redirect::route($this->prefix . 'brands.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $brand = Brand::find($id);
    $brand->delete();

    return Redirect::back();
  }


}
