<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ArticlePrice extends Eloquent {

  protected $table = 'articles_prices';
  public $timestamps = FALSE;
  
  public static $rules = array(
    'name' => 'required',
  );

  public function Article() {
    return $this->belongsTo('Devfactory\Elshop\Models\Article');
  }

  public function Currency() {
    return $this->belongsTo('Devfactory\Elshop\Models\Currency');
  }
  
}