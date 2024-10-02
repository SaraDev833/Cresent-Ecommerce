<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    function delivery_charge()
    {
        $charges = Charge::all();
        return view('admin.delivery_charge.charge', [
            'charges' => $charges,
        ]);
    }
    function add_charge(Request $request)
    {
        Charge::insert([
            'location' => $request->location,
            'charge' => $request->charge,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function charge_delete($id)
    {
        Charge::find($id)->delete();
        return back();
    }
}
