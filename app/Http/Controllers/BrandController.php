<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function brand()
    {
        $brands = Brand::all();
        return view('admin.brand.brand', [
            'brands' => $brands,
        ]);
    }
    function add_brand(Request $request)
    {
        Brand::insert([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('added', 'Brand Added!!');
    }
}
