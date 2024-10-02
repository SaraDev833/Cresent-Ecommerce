<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.product.variation', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
    function add_color(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function add_size(Request $request)
    {
        Size::insert([
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function delete_color($id)
    {
        Color::find($id)->delete();
        return back();
    }
    function delete_size($id)
    {
        Size::find($id)->delete();
        return back();
    }
    function inventory($id)
    {
        $product = Product::find($id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $id)->get();
        return view('admin.product.inventory', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }
    function add_inventory(Request $request, $id)
    {
        $product = Product::find($id);
        $discount = $product->discount;

        $discount_price = $request->price * $discount / 100;
        $after_discount_price = $request->price - $discount_price;

        Inventory::insert([
            'product_id' => $id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'after_discount_price' => $after_discount_price,
        ]);
        return back()->with('added', 'Inventory added successfully!!');
    }
    function delete_inventory($id)
    {
        Inventory::find($id)->delete();
        return back();
    }
}
