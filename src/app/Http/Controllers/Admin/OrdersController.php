<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Status;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = Order::all();

        return view('admin.orders.index')
        ->withOrders($orders);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Order::find($id)->delete();

        return redirect()->route('admin.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $order = Order::find($id);

        return view('admin.orders.show')
        ->withOrder($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $order = Order::find($id);
        $statuses = Status::all();

        return view('admin.orders.edit')
        ->withOrder($order)
        ->withStatues($statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $order = Order::find($id);        
        $data = $request->all();
        $data['status_id'] = $request->status;
        $this->validate($request, [
            'status' => 'required',
        ]);
        $order->update($data);

        return redirect()->route('admin.orders.index');
    }
}
