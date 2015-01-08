<?php

namespace Devfactory\Elshop\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends Eloquent {

  public static $rules = array(
  );

  /**
   * Get the detail from an order
   * 
   * @return All the order items
   */
  public function details() {
    return $this->hasMany('Devfactory\Elshop\Models\OrderDetail');
  }

  /**
   * Get the item number of the order
   *       
   * @return int The item number
   */
  public function quantity() {
    $carts = $this->details()->get();
    $quantity = 0;
    foreach ($carts as $cart) {
      $quantity += $cart->quantity;
    }

    return $quantity;
  }

  /**
   * Get the total from the order details
   * 
   * @return int The order total
   */
  public function total($parcel = 0) {
    $carts = $this->details()->get();
    $total = 0;
    foreach ($carts as $cart) {
      $total += $cart->price * $cart->quantity;
    }
    $total += $parcel * 100;

    return $total / 100;
  }

  public function invoice() {
    return $this->belongsTo('Devfactory\Elshop\Models\Address', 'invoice_id', 'id');
  }

  public function delivery() {
    return $this->belongsTo('Devfactory\Elshop\Models\Address', 'delivery_id', 'id');
  }

}
