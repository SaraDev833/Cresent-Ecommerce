<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function search(Request $request)
    {
        $categories = Category::all();
        $search_item = $request->input('search');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('sub_id');
        $all_products = Product::latest()->get();
        $products = Product::query();

        $products->join('inventories', 'products.id', '=', 'inventories.product_id')
            ->select('products.*', DB::raw('MIN(inventories.after_discount_price) as after_discount_price'))
            ->groupBy('products.id');

        // Check for category_id
        if ($request->has('category_id') && !is_null($request->input('category_id'))) {
            $products->where('category_id', $request->category_id);
        }

        // Check for sub_id
        if ($request->has('sub_id') && !is_null($request->input('sub_id'))) {
            $products->where('subcategory_id', $request->sub_id);
        }
        // Check for item_it
        if ($request->has('item_id') && !is_null($request->input('item_id'))) {
            $products->where('items_id', $request->item_id);
        }

        // Search
        if ($search_item) {
            $products->where(function ($query) use ($search_item) {
                $query->where('product_name', 'like', '%' . $search_item . '%')
                    ->orWhere('short_desp', 'like', '%' . $search_item . '%')
                    ->orWhere('long_desp', 'like', '%' . $search_item . '%');
            });
        }
        // short
        if ($request->input('short') === 'high_to_low') {
            $products->orderBy('after_discount_price', 'desc');
        } elseif ($request->input('short') === 'low_to_high') {
            $products->orderBy('after_discount_price', 'asc');
        }
        $products = $products->get();

        return view('frontend.shop.shop', [
            'categories' => $categories,
            'products' => $products,
            'all_products' => $all_products,
            'search_item' => $search_item,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
        ]);
    }
}
