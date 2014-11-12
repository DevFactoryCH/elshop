<?php 
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Config;

use Devfactory\Elshop\Models\Brand;

class BrandController extends \Devfactory\Elshop\Controllers\ElshopController
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $prefix = $this->prefix;
    $brands = Brand::all();

    return View::make('elshop::brands.index', compact('brands', 'prefix'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $prefix = $this->prefix;
    return View::make('elshop::brands.create', compact('prefix'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make(Input::All(), Brand::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $brand = new Brand();
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
    //
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    //
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
