<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Payment;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $payments = Payment::all();
        
        return view('admin.payments.index')
        ->withPayments($payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $payments = Payment::find($id);

        return view('admin.payments.edit')
        ->withPayment($payments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $payment = Payment::find($id);
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->all();
        if ($request->has('enable')) {
            $data['enable'] = TRUE;
        }
        else {
            $data['enable'] = FALSE;
        }
        $payment_method->update($data);

        return redirect()->route('admin.payments.index');
    }
}
