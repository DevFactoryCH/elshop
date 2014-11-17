<?php 
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Str;
use Config;
use Taxonomy;

use Devfactory\Elshop\Models\Article;
use Devfactory\Elshop\Models\Brand;
use Devfactory\Elshop\Models\ArticleLanguage;
use Devfactory\Elshop\Models\Language;

class ArticleController extends \Devfactory\Elshop\Controllers\ElshopController
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $articles = Article::all();

    return View::make('elshop::articles.index', compact('articles'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $brands = Brand::lists('id', 'name');
    $brands = array_flip($brands);
    $vocabulary_name = Config::get('elshop::vocabulary_name');
    $rubric = Taxonomy::getVocabularyByName($vocabulary_name);
    $terms = array('' => NULL);
    foreach ($rubric->terms()->get() as $term) {
      $terms[$term->id] = $term->name;
    }
    
    return View::make('elshop::articles.create', compact('brands', 'terms'));
  }


  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $validator = Validator::make(Input::All(), Article::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $article = new Article();
    $article->price = Input::get('price') * 100;
    $article->sale_price = Input::get('sale_price') * 100;
    $article->weight = Input::get('weight');
    $article->ean13 = Input::get('ean13');
    $article->brand_id = Input::get('brand');
    $article->save();

    $default_language = Language::where('default', TRUE)->first();

    $article_language = new ArticleLanguage();
    $article_language->language_id = $default_language->id;
    $article_language->article_id = $article->id;
    $article_language->name = Input::get('name');
    $article_language->teaser = Input::get('teaser');
    $article_language->description = Input::get('description');
    $article_language->slug = Str::slug(Input::get('name'));
    $article_language->save();

    return Redirect::route($this->prefix . 'articles.index');
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
    $prefix = $this->prefix;
    $article = Article::find($id);
    $brands = Brand::lists('id', 'name');
    $brands = array_flip($brands);

    return View::make('elshop::articles.edit', compact('article', 'brands', 'prefix'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $validator = Validator::make(Input::All(), Article::$rules);
    if ($validator->fails()) {
      return Redirect::back()->withInput()->withErrors($validator);
    }

    $article = Article::find($id);
    $article->price = Input::get('price') * 100;
    $article->sale_price = Input::get('sale_price') * 100;
    $article->weight = Input::get('weight');
    $article->ean13 = Input::get('ean13');
    $article->brand_id = Input::get('brand');
    $article->save();

    $default_language = Language::where('default', TRUE)->first();

    $article_language = ArticleLanguage::find($article->content->id);
    $article_language->name = Input::get('name');
    $article_language->teaser = Input::get('teaser');
    $article_language->description = Input::get('description');
    $article_language->slug = Str::slug(Input::get('name'));
    $article_language->save();

    return Redirect::route($this->prefix . 'articles.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  { 
    $article = Article::find($id);
    $article->delete();

    return Redirect::back();
  }


}
