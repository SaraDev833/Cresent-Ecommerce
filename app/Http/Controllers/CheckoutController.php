<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Charge;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class CheckoutController extends Controller
{
    function checkout()
    {
        $categories = Category::all();
        $countries = Country::all();
        $charges = Charge::all();
        return view('frontend.checkout.checkout', [
            'categories' => $categories,
            'countries' => $countries,
            'charges' => $charges,
        ]);
    }
    function get_city(Request $request)
    {
        $string = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $string .= ' <option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $string;
    }
    function order_store(Request $request)
    {
        $order_id = uniqid();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'company' => 'required',
            'address' => 'required',
            'notes' => 'required',
        ]);
        if ($request->payment == 2) {
            Order::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'total' => $request->total_price,
                'charge' => $request->delivery_charge,
                'payment' => $request->payment,
                'created_at' => Carbon::now(),
            ]);

            Billing::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'name' => $request->name,
                'email' => $request->email,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'phone' => $request->phone,
                'company' => $request->company,
                'address' => $request->address,
                'notes' => $request->notes,
                'created_at' => Carbon::now(),
            ]);
            $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
            foreach ($carts as $cart) {
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now(),
                ]);
                Cart::find($cart->id)->delete();
                Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }

            return redirect()->route('order.success');
        }

        if ($request->payment == 1) {
            $data = $request->all();
            return redirect()->route('stripe.pay')->with('data', $data);
        }
    }
}
