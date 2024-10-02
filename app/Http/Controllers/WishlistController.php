<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    function wishlist()
    {
        $categories = Category::all();
        $customer_id = Auth::guard('customer')->id();
        $wishlists = Wishlist::where('customer_id', $customer_id)
            ->selectRaw('MIN(id) as id, product_id')
            ->groupBy('product_id')
            ->get();
        return view('frontend.wishlist.wishlist', [
            'categories' => $categories,
            'wishlists' => $wishlists,
        ]);
    }
    function add_wishlist(Request $request)
    {

        Wishlist::insert([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function remove_wishlist($id)
    {
        Wishlist::find($id)->delete();

        return back();
    }
}
