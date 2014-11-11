<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Brand extends Eloquent {

  public static $rules = array(
    'name' => 'required'
  );
  
}