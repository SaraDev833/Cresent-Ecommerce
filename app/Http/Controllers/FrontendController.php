<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    function welcome()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $banners = Banner::all();
        $newProducts = Product::latest()->take(4)->get();
        $products = Product::latest()->get();
        $trending_products = Product::orderBy('views', 'desc')->take(4)->get();

        $deals = Deal::latest()->take(1)->get();
        return view('frontend.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'banners' => $banners,
            'newProducts' => $newProducts,
            'products' => $products,
            'trending_products' => $trending_products,
            'deals' => $deals,
        ]);
    }
    function view_product($slug)
    {
        $categories = Category::all();
        $product_detail = Product::where('slug', $slug)->get();
        $product_id = $product_detail->first()->id;

        $product = Product::find($product_id);
        if ($product) {
            $product->increment('views');
        }
        $inventories = Inventory::where('product_id', $product_detail->first()->id)
            ->groupBy('color_id')
            ->selectRaw('count(*) as total , color_id')
            ->get();
        $inventory_sizes = Inventory::where('product_id', $product_detail->first()->id)
            ->groupBy('size_id')
            ->selectRaw('count(*) as total , size_id')
            ->get();
        // $reviews = OrderProduct::where('product_id', $product_id)->whereNotNull('reviews')->get();

        $stars = OrderProduct::where('product_id', $product_detail->first()->id)->whereNotNull('reviews')->sum('stars');
        $galleries = Gallery::where('product_id', $product_detail->first()->id)->get();
        $wishlist = Wishlist::where('product_id', $product_detail->first()->id)->where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.product.product', [
            'categories' => $categories,
            // 'product' => $product,
            'galleries' => $galleries,
            'inventories' => $inventories,
            'inventory_sizes' => $inventory_sizes,
            'wishlist' => $wishlist,
            // 'reviews' => $reviews,
            'stars' => $stars,
            'product_detail' => $product_detail,
        ]);
        return back();
    }
    function get_size(Request $request)
    {
        $string = '';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();
        foreach ($sizes as $size) {
            $string .= '<button name="size_id"  class="w-8 h-8 transition-all border-2 rounded-sm hover:border-gray-400 bg-gray-50 shrink-0 " type="button" id="size_id" value="' . $size->size_id . '" data-size="' . $size->size_id . '">' . $size->rel_to_size->size_name . '</button>';
        }
        echo $string;
    }
    public function get_price(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:inventories,color_id',
            'size_id' => 'required|exists:inventories,size_id',
        ]);

        $product = Product::find($request->product_id);
        $prices = Inventory::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->get();

        if ($prices->isEmpty()) {
            return response()->json(['message' => 'No prices available'], 404);
        }

        // Prepare the response price data
        $response = [];
        foreach ($prices as $price) {
            if ($product->discount != 0) {
                $response['price'] = '$' . $price->after_discount_price;
                $response['original_price'] = '$' . $price->price;
            } else {
                $response['original_price'] = '$' . $price->price;
            }
            break; // Assuming we only need the first matching price
        }

        return response()->json($response);
    }


    function get_quantity(Request $request)
    {
        $string = "";
        $quantities = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->get();
        foreach ($quantities as $quantity) {

            $string .= '' . $quantity->quantity . '';
        }
        echo $string;
    }
    function add_review(Request $request, $id)
    {
        echo $id;

        $request->validate([
            'star' => 'required',
            'review' => 'required',
        ], [
            'star.required' => 'You have not rated !',
            'review.required' => 'Give your valuable review!'
        ]);
        OrderProduct::where('product_id', $id)->where('customer_id', Auth::guard('customer')->id())->first()->update([
            'reviews' => $request->review,
            'stars' => $request->star,
            'updated_at' => Carbon::now(),
        ]);


        return back();
    }
}
