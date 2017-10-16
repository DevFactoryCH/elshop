<?php

namespace Devfactory\Elshop\app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $addresses = Address::all();

        return view('admin.addresses.index')
        ->withAddresses($addresses);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Address::find($id)->delete();
        
        return redirect()->route('admin.addresses.index');
    }
}
