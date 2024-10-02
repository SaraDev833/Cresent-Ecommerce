<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubcategoryItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function subcategory()
    {
        $categories = Category::all();
        return view('admin.category.subcategory', [
            'categories' => $categories,
        ]);
    }
    function add_subcategory(Request $request)
    {
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('added', 'Subategory addedd Successfully!');
    }
    function sub_delete($id)
    {
        Subcategory::find($id)->delete();
        return back()->with('delete', 'subcategory deleted successfully!!');
    }
    function get_sub(Request $request)
    {
        $string = '';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach ($subcategories as $subcategory) {
            $string .= ' <option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        };
        echo $string;
    }
    function subcategory_items()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subitems = SubcategoryItem::all();
        return view('admin.category.subcategory_item', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'subitems' => $subitems,
        ]);
    }
    function add_subcategory_item(Request $request)
    {
        SubcategoryItem::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_item_name' => $request->item_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function get_subcategory(Request $request)
    {
        $string = '';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach ($subcategories as $subcategory) {
            $string .= ' <option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $string;
    }
    function item_delete($id)
    {
        SubcategoryItem::find($id)->delete();
        return back();
    }
    function get_items(Request $request)
    {
        $string = '';
        $items = SubcategoryItem::where('subcategory_id', $request->subcategory_id)->get();
        foreach ($items as $item) {
            $string .= ' <option value="' . $item->id . '">' . $item->sub_item_name . '</option>';
        }
        echo $string;
    }
}
