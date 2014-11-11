<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ArticleLanguage extends Eloquent {

  protected $table = 'articles_languages';

  public static $rules = array(
    'name' => 'required',
  );

  public function Article() {
    return $this->belongsTo('Devfactory\Elshop\Models\Article');
  }

  public function Language() {
    return $this->belongsTo('Devfactory\Elshop\Models\Language');
  }
  
}