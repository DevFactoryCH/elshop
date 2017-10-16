<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Tracking;
use App\Models\Order;
use App\Models\Status;

class TrackingsController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'url' => 'required',
            'provider' => 'required',
            'number' => 'required',
        ]);
        Tracking::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function destroy($id){
        Tracking::find($id)->delete();

        return redirect()->route('admin.orders.index');
    }
}
