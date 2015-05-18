<?php
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Str;
use Config;
use Taxonomy;

use Devfactory\Elshop\Models\Category;

class CategoryController extends \Devfactory\Elshop\Controllers\ElshopController
{
  protected $categories;

  public function __construct() {
    parent::__construct();
    // Categories
    $categories = Category::where('category_id', NULL)->get();
    foreach ($categories as $category) {
      $this->categories[$category->id] = $category->category;
      foreach($category->categories()->get() as $child) {
        $this->categories[$child->id] = ' - ' . $child->category;
      }
    }
    $this->categories[NULL] = 'Parent';
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories = Category::where('category_id', NULL)
    ->orderBy('category', 'ASC')
    ->get();

    return View::make('elshop::categories.index', compact('categories'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $categories = $this->categories;

    return View::make('elshop::categories.create', compact('categories'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make($data = Input::All(), Category::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    if (Input::has('parent')) {
      $data['category_id'] = Input::get('parent');
    }

    Category::create($data);

    return Redirect::route($this->prefix . 'categories.index');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $currencies = Currency::all();
    $select_currencies = array();
    foreach ($currencies as $currency) {
      if (!ArticlePrice::where('article_id', $id)->where('currency_id', $currency->id)->where('sale_price', TRUE)->count()) {
        $select_currencies[$currency->id] = $currency->iso_code;
      }
    }
    $currencies = $select_currencies;
    $article = Article::find($id);

    return View::make('elshop::articles.show', compact('article', 'currencies'));
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $category = Category::find($id);
    $categories = $this->categories;

    return View::make('elshop::categories.edit', compact(
      'categories',
      'category'
    ));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $validator = Validator::make($data = Input::All(), Category::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    if (Input::has('parent')) {
      $data['category_id'] = Input::get('parent');
    }

    $category = Category::find($id);
    $category->update($data);

    return Redirect::route($this->prefix . 'categories.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();

    return Redirect::back();
  }

  public function changeStatus($id) {
    $category = Category::find($id);

    if (!$category) {
      return Redirect::back();
    }

    if ($category->status) {
      $category->status = FALSE;
    }
    else {
      $category->status = TRUE;
    }

    $category->save();

    return Redirect::back();
  }
}
