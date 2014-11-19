<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Currency extends Eloquent {

   public $timestamps = FALSE;

  public static $rules = array(
    'name' => 'required',
    'iso_code' => 'required',
    'sign' => 'required',
  );

}