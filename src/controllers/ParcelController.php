<?php
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Config;

use Devfactory\Elshop\Models\Parcel;

class ParcelController extends \Devfactory\Elshop\Controllers\ElshopController
{
  protected $types;
  protected $weight;

  public function __construct() {
    parent::__construct();
    $this->types[] = trans('elshop::parcel.between');
    $this->types[] = trans('elshop::parcel.less');
    $this->types[] = trans('elshop::parcel.greater');
  }  

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $parcels = Parcel::orderBy('price', 'ASC')->get();

    return View::make('elshop::parcels.index', compact('parcels'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $types = $this->types;

    return View::make('elshop::parcels.create', compact('types'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make(Input::All(), Parcel::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $parcel = new Parcel();
    $parcel->min = Input::get('min') * 100;
    $parcel->max = NULL;
    $parcel->type = Input::get('type');
    if (Input::has('max')) {
      $parcel->max = Input::get('max') * 100;
    }
    $parcel->price = Input::get('price') * 100;
    $parcel->save();

    return Redirect::route($this->prefix . 'parcels.index');
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
    $parcel = Parcel::find($id);
    $types = $this->types;

    return View::make('elshop::parcels.edit', compact('parcel', 'types'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $validator = Validator::make(Input::All(), Parcel::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $parcel = Parcel::find($id);
    $parcel->min = Input::get('min') * 100;
    $parcel->max = NULL;
    $parcel->type = Input::get('type');
    if (Input::has('max')) {
      $parcel->max = Input::get('max') * 100;
    }
    $parcel->price = Input::get('price') * 100;
    $parcel->save();

    return Redirect::route($this->prefix . 'parcels.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $parcel = Parcel::find($id);
    $parcel->delete();

    return Redirect::back();
  }



}
