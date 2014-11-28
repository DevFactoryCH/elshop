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
use Devfactory\Elshop\Models\Currency;
use Devfactory\Elshop\Models\ArticlePrice;

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
    $currencies = Currency::lists('id', 'iso_code');
    $currencies = array_flip($currencies);
    $brands = Brand::lists('id', 'name');
    $brands = array_flip($brands);
    $vocabulary_name = Config::get('elshop::vocabulary_name');
    $rubric = Taxonomy::getVocabularyByName($vocabulary_name);
    $terms = array('' => NULL);
    foreach ($rubric->terms()->get() as $term) {
      $terms[$term->id] = $term->name;
    }

    return View::make('elshop::articles.create', compact('brands', 'terms', 'currencies'));
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

    $article_price = new ArticlePrice();
    $article_price->price = Input::get('price') * 100;
    $article_price->sale_price = FALSE;
    $article_price->article_id = $article->id;
    $article_price->currency_id = Input::get('currency');
    $article_price->save();

    return Redirect::route($this->prefix . 'articles.edit', $article->id);
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
    $vocabulary_name = Config::get('elshop::vocabulary_name');
    $rubric = Taxonomy::getVocabularyByName($vocabulary_name);
    $terms = array('' => NULL);
    foreach ($rubric->terms()->get() as $term) {
      $terms[$term->id] = $term->name;
    }

    $article = Article::find($id);
    $brands = Brand::lists('id', 'name');
    $brands = array_flip($brands);
    $currencies = Currency::all();
    $select_currencies = array();
    foreach ($currencies as $currency) {
      if (!ArticlePrice::where('article_id', $id)->where('currency_id', $currency->id)->where('sale_price', TRUE)->count()) {
        $select_currencies[$currency->id] = $currency->iso_code;
      }
    }
    $currencies = $select_currencies;
    $currencies_purchase = Currency::lists('id', 'iso_code');
    $currencies_purchase = array_flip($currencies_purchase);

    return View::make('elshop::articles.edit', compact('article', 'brands', 'terms' , 'currencies', 'currencies_purchase'));
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

  public function storePrice($id) {
    $article_price = new ArticlePrice();
    $article_price->price = Input::get('price') * 100;
    $article_price->sale_price = TRUE;
    $article_price->article_id = $id;
    $article_price->currency_id = Input::get('currency');
    $article_price->save();

    return Redirect::route($this->prefix . 'articles.edit', $id);
  }

  public function destroyPrice($id) {
    $article_price = ArticlePrice::find($id);
    $article_price->delete();

    return Redirect::back();
  }
}
