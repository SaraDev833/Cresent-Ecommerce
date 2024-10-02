<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class OrderController extends Controller
{
    function order_success()
    {
        $categories = Category::all();
        return view('frontend.order.order_success', [
            'categories' => $categories,

        ]);
    }
    function order($id)
    {
        $categories = Category::all();
        $orders = OrderProduct::where('customer_id', $id)->latest()->get();

        return view('frontend.order.order', [
            'categories' => $categories,
            'orders' => $orders,
        ]);
    }
    function order_list()
    {
        $orders = Order::latest()->get();
        return view('admin.order.order_list', [
            'orders' => $orders,
        ]);
    }
    function order_status_update(Request $request, $id)
    {
        Order::find($id)->update([
            'status' => $request->status,

        ]);
        return back();
    }
    function order_delete($order_id)
    {
        Order::where('order_id', $order_id)->update([
            'status' => 0,
        ]);
        return back();
    }
}
