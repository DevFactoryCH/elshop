<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Currency extends Eloquent {

  public static $rules = array(
    'name' => 'required'
  );

}