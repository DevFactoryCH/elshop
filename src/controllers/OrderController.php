<?php
namespace Devfactory\Elshop\Controllers;

use View;
use Input;
use Redirect;
use Validator;
use Config;

use Devfactory\Elshop\Models\Order;
use Devfactory\Elshop\Models\Parcel;

class OrderController extends \Devfactory\Elshop\Controllers\ElshopController
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $orders = Order::all();

    return View::make('elshop::orders.index', compact('orders'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $order = Order::find($id);
    if (!$order) {
      return Redirect::route($this->prefix . 'orders.index');
    }

    $parcel = Parcel::getPrice($order);
    $tva = ceil($order->total() / 100 * 8);
    $total_order = $order->total() + ($parcel / 100);

    //$total_order += $tva;

    return View::make('elshop::orders.show', compact('order', 'tva', 'parcel', 'total_order'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $order = Order::find($id);
    $order->delete();

    return Redirect::back();
  }

}