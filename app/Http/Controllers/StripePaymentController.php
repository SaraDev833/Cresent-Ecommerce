<?php

namespace App\Http\Controllers;

use App\Models\Stripe as ModelsStripe;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $data = session('data');
        $total = $data['total_price'];
        $insert_id = ModelsStripe::insertGetId([
            'tans_id' => uniqid(),
            'customer_id' => $data['customer_id'],
            'total' => $data['total_price'],
            'charge' => $data['delivery_charge'],
            'name' => $data['name'],
            'email' => $data['email'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'notes' => $data['notes'],
            'company' => $data['company'],
            'created_at' => Carbon::now(),
        ]);

        return view('stripe', [
            'insert_id' => $insert_id,
            'total' => $total,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $data = ModelsStripe::find($request->stripe_id);
        Stripe\Charge::create([
            "amount" => 100 * $data->total,
            "currency" => "bdt",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $order_id = uniqid();

        Order::insert([
            'order_id' => $order_id,
            'customer_id' => $data->customer_id,
            'total' => $data->total,
            'charge' => $data->charge,
            'payment' => 2,
            'created_at' => Carbon::now(),
        ]);

        Billing::insert([
            'order_id' => $order_id,
            'customer_id' => $data->customer_id,
            'name' => $data->name,
            'email' => $data->email,
            'country_id' => $data->country_id,
            'city_id' => $data->city_id,
            'phone' => $data->phone,
            'company' => $data->company,
            'address' => $data->address,
            'notes' => $data->notes,
            'created_at' => Carbon::now(),
        ]);
        $carts = Cart::where('customer_id', $data->customer_id)->get();
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
}
