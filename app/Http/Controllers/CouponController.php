<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon', [
            'coupons' => $coupons,
        ]);;
    }
    function add_coupon(Request $request)
    {
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_type' => $request->coupon_type,
            'amount' => $request->amount,
            'min_purchase' => $request->min_purchase,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function coupon_delete($id)
    {
        Coupon::find($id)->delete();
        return back();
    }
}
