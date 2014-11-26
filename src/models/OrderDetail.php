<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class OrderDetail extends Eloquent {

  protected $table = 'order_details';
  public $timestamps = FALSE;
  
  public static $rules = array(
  );
  
}