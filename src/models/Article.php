<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent {

  use \Devfactory\Taxonomy\TaxonomyTrait;
  use \Devfactory\Media\MediaTrait;

  public static $rules = array(
    'name' => 'required',
    'price' => 'required|numeric',
    'description' => 'required',
  );

  public function brand() {
    return $this->belongsTo('Devfactory\Elshop\Models\Brand');
  }

  public function prices() {
    return $this->hasMany('Devfactory\Elshop\Models\ArticlePrice')->where('sale_price', TRUE);
  }

  public function price($currency_id = NULL) {
    if (!$currency_id) {
      $currency = Currency::where('default', TRUE)->first();
    }
    else {
      $currency = Currency::where('id', $currency_id)->first();
    }

    return $this->hasOne('Devfactory\Elshop\Models\ArticlePrice')->where('sale_price', TRUE)->where('currency_id', $currency->id);
  }

  public function purchasing() {
    return $this->hasOne('Devfactory\Elshop\Models\ArticlePrice')->where('sale_price', FALSE);
  }

  /**
   * Return the content with the good language
   * @param  int $language_id
   * @return content the content from the current language
   */
  public function content($language_id = NULL) {
    if ($language_id) {
      return $this->hasOne('Devfactory\Elshop\Models\ArticleLanguage', 'article_id')->where('language_id', $language->id);
    }
    else {
      $language = Language::where('default', TRUE)->first();
      
      return $this->hasOne('Devfactory\Elshop\Models\ArticleLanguage', 'article_id')->where('language_id', $language->id);
    }
  }

  public function formatPrice($currency_id = NULL, $decimal = 2) {
    if (!$currency_id) {
      $currency = Currency::where('default', TRUE)->first();
    }
    else {
      $currency = Currency::where('id', $currency_id)->first();
    }

    $price = $this->hasOne('Devfactory\Elshop\Models\ArticlePrice')->where('sale_price', TRUE)->where('currency_id', $currency->id)->first();
    if ($price) {
      $price = $price->price / 100;
      return number_format($price, $decimal, '.', "'") . ' ' . $currency->sign;
    }

    return FALSE;
  }

  public function categories() {
    return $this->belongsToMany('Category', 'articles_categories');
  }
  
}