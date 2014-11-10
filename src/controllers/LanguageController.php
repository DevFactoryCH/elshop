<?php 
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;

use Language;

class LanguageController extends \BaseController
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $languages =  Language::all();

    return View::make('devfactory/elshop::languages.index', compact('languages'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

    return View::make('devfactory/elshop::languages.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make(Input::All(), Language::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $languages = Language::where('default', TRUE)->count();

    $language = new Language();
    $language->name = Input::get('language');
    $language->iso_code = Input::get('iso_code');
    $language->code = Input::get('code');
    if ($languages) {
      $language->default = FALSE;
    }
    else {
      $language->default = TRUE;
    }
    $language->status = TRUE;
    $language->save();

    return Redirect::route('languages.index');
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
    $language = Language::find($id);
    $language->delete();

    return Redirect::back();
  }


}
