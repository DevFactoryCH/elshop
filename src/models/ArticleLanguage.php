<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ArticleLanguage extends Eloquent {

  protected $table = 'articles_languages';

  public static $rules = array(
    'name' => 'required',
  );

  public function Article() {
    return $this->belongsTo('Article');
  }

  public function Language() {
    return $this->belongsTo('Language');
  }
  
}