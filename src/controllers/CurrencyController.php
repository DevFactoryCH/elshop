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
    return View::make('elshop::currencies.create');
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

    $currency = new Currency();
    $currency->name = Input::get('name');
    $currency->iso_code = Input::get('iso_code');
    $currency->sign = Input::get('sign');
    $currency->status = TRUE;
    $currency->default = FALSE;
    if (!Currency::count()) {
      $currency->default = TRUE;
    }
    $currency->save();

    return Redirect::route($this->prefix . 'currencies.index');
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
    $currencie = Currency::find($id);

    return View::make('elshop::currencies.edit', compact('currencie'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $validator = Validator::make(Input::All(), Currency::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $currencie = Currency::find($id);
    $currencie->name = Input::get('name');
    $currencie->iso_code = Input::get('iso_code');
    $currencie->sign = Input::get('sign');
    $currencie->save();

    return Redirect::route($this->prefix . 'currencies.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $currency = Currency::find($id);
    $currency->delete();

    return Redirect::back();
  }


}
