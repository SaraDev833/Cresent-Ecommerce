<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    function cart_page(Request $request)
    {
        $categories = Category::all();


        $coupon_name = $request->coupon_name;
        $amount = '';
        $coupon_type = '';
        $min_purchase = '';
        $msg = '';

        if (Customer::where('id', Auth::guard('customer')->id())->exists()) {
            $customer = Auth::guard('customer')->user();
            $carts = Cart::where('customer_id', $customer->id)->get();
            if (Coupon::where('coupon_name', $coupon_name)->exists()) {
                if (Coupon::where('coupon_name', $coupon_name)->first()->validity > Carbon::now()) {
                    $amount = Coupon::where('coupon_name', $coupon_name)->first()->amount;
                    $coupon_type = Coupon::where('coupon_name', $coupon_name)->first()->coupon_type;
                    $min_purchase = Coupon::where('coupon_name', $coupon_name)->first()->min_purchase;
                } else {
                    $amount = 0;
                    $msg = 'code expired';
                }
            } else {
                $amount = 0;
                $msg = 'coupon invalid';
            }


            return view('frontend.cart.cart', [
                'categories' => $categories,
                'carts' => $carts,
                'amount' => $amount,
                'coupon_type' => $coupon_type,
                'min_purchase' => $min_purchase,
                'msg' => $msg,
                'coupon_name' => $coupon_name,
            ]);
        } else {
            return redirect()->route('customer.login');
        }
    }
    function add_cart(Request $request, $id)
    {
        $product = Product::find($id);

        if (Customer::where('id', Auth::guard('customer')->id())->exists()) {
            if (Inventory::where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity >= $request->quantity) {
                Cart::insert([
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $id,
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
                    'quantity' => $request->quantity,
                    'created_at' => Carbon::now(),
                ]);
                return back();
            } else {
                return back()->with('error', 'Out of Stock');
            }
        } else {
            return redirect()->route('customer.login');
        }
    }
    function update_cart(Request $request)
    {
        foreach ($request->quantity as $cart_id => $quantity) {
            Cart::find($cart_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back();
    }
    function delete($id)
    {

        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }
        $cart_item = Cart::where('id', $id)->where('customer_id', Auth::guard('customer')->id())->first();
        if (!$cart_item) {
            return back()->with('error', 'Cart item not found.');
        }

        $cart_item->delete();

        return back()->with('success', 'Cart item removed successfully.');
    }
}
