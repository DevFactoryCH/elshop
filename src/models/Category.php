<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

  public static $rules = [
    'category' => 'required',
  ];

  protected $fillable = [
    'category',
    'category_id',
    'status',
  ];

  public function categories() {
    return $this->hasMany('Devfactory\Elshop\Models\Category');
  }


}