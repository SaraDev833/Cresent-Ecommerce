<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DealController extends Controller
{
    function deal()
    {
        $product = Product::orderBy('discount', 'desc')
            ->orderBy('created_at', 'desc')->take(1)->first();
        $deals = Deal::all();
        return view('admin.deal.deal', [
            'product' => $product,
            'deals' => $deals,
        ]);
    }
    function add_deal(Request $request, $id)
    {
        Deal::insert([
            'product_name' => $request->product_name,
            'product_id' => $id,
            'start_date' => $request->starting_date,
            'end_date' => $request->ending_date,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function delete_deal($id)
    {
        Deal::find($id)->delete();
        return back();
    }
}
