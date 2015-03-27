<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Brand extends Eloquent {

  use \Devfactory\Media\MediaTrait;

  public static $rules = array(
    'name' => 'required'
  );

  protected $fillable = [
    'name',
    'website',
    'status',
  ];
  
}