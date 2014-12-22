<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Parcel extends Eloquent {

  public static $rules = array(
    'min' => 'required|numeric',
    'max' => 'numeric',
  );

  public $timestamps = FALSE;
  
}
