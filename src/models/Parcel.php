<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Parcel extends Eloquent {

  public static $rules = array(
    'min' => 'required|numeric',
    'max' => 'required_if:type,0|numeric',
    'price' => 'required|numeric',
  );

  public $timestamps = FALSE;

  public static function price($weight) {
    
  }
  
}
