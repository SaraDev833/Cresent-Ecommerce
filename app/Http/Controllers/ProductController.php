<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SubcategoryItem;
use App\Models\Tag;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    function product()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $items = SubcategoryItem::all();

        return view('admin.product.product', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'tags' => $tags,
            'items' => $items,
        ]);
    }

    function add_product(Request $request)
    {

        $slug = Str::lower(str_replace('', '-', $request->product_name) . '-' . random_int('20000', '99999'));

        $image = $request->preview;
        $extension = $image->extension();
        $file_name = uniqid() . '.' . $extension;
        Image::make($image)->save(public_path('uploads/products/preview/' . $file_name));

        $tags = $request->tag_id;
        $after_implode = implode(',', $tags);


        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'items_id' => $request->items_id,
            'product_name' => $request->product_name,
            'brand_id' => $request->brand,
            'sku' => $request->sku,
            'discount' => $request->discount,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'tag_id' => $after_implode,
            'preview' => $file_name,
            'slug' => $slug,
            'created_at' => Carbon::now(),
        ]);

        $gallery_image = $request->gallery;
        foreach ($gallery_image as $gallery) {

            $extension2 = $gallery->extension();
            $file_name2 = uniqid() . '.' . $extension2;
            Image::make($gallery)->save(public_path('uploads/products/galleries/' . $file_name2));

            Gallery::insert([
                'product_id' => $product_id,
                'gallery_name' => $file_name2,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', 'product added successfully!!');
    }
    function product_list()
    {
        $products = Product::all();
        return view('admin.product.product_list', [
            'products' => $products,
        ]);
    }
    function product_view($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->increment('views');
        }
        return view('admin.product.view_product', [
            'product' => $product,

        ]);
    }
    function delete_product($id)
    {

        $product = Product::find($id);


        if ($product) {

            if ($product->preview) {
                $delete_from = public_path('uploads/products/preview/' . $product->preview);
                if (file_exists($delete_from)) {
                    unlink($delete_from);
                }
            }
            $galleries = Gallery::where('product_id', $id)->get();

            foreach ($galleries as $gallery) {
                if ($gallery->gallery_name) {
                    $delete_from_gallery = public_path('uploads/products/galleries/' . $gallery->gallery_name);
                    if (file_exists($delete_from_gallery)) {
                        unlink($delete_from_gallery);
                    }
                }
                $gallery->delete();
            }


            $product->delete();
        }


        return back();
    }
}
