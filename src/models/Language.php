<?php
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Language extends Eloquent {

  public static $rules = array(
    'language' => 'required',
  ); 
}