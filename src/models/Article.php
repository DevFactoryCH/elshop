<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent {

  public static $rules = array(
    'name' => 'required',
    'price' => 'required|numeric',
    'sale_price' => 'required|numeric',
    'weight' => 'required|numeric',
    'ean13' => 'numeric',
    'description' => 'required',
  );

  public function brand() {
    return $this->belongsTo('Devfactory\Elshop\Models\Brand');
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
  
}