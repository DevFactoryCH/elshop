<?php
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Config;
use Admin;

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
    $brands = Brand::all();

    return View::make('elshop::brands.index', compact('brands'));
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
    $validator = Validator::make(Input::All(), Brand::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $brand = new Brand();
    $brand->name = Input::get('name');
    $brand->website = Input::get('website');
    $brand->status = TRUE;
    $brand->save();

    Admin::handleFileUpload('image', $brand, 'image');


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
    $brand->website = Input::get('website');
    $brand->save();

    Admin::handleFileUpload('image', $brand, 'image');

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
