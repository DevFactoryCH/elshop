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

  /**
   * Get the parcel price for an order 
   * @param  int $total    Can be the total price of the order or the total weight
   * @return int return False if we not found parcel price else we return the parcel price
   */
  public static function getPrice($total) {
    $parcels = Parcel::all();
    $total = $total * 100;

    foreach ($parcels as $parcel) {
      if ($parcel->type == 0 && $total >= $parcel->min && $total <= $parcel->max) {
        return $parcel->price;
      }
      elseif ($total <= $parcel->min && $parcel->type == 1) {
        return $parcel->price;
      }
      elseif ($total >= $parcel->min && $parcel->type == 2) {
        return $parcel->price;
      }
    }

    return FALSE;
  }
  
}
