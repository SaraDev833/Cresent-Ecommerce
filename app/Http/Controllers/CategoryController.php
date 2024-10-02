<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function category()
    {
        $categories = Category::all();
        return view('admin.category.category', [
            'categories' => $categories,
        ]);
    }

    function add_category(Request $request)
    {

        $slug = Str::lower(str_replace('', '-', $request->category_name) . '-' . random_int('200000', '999999'));

        $photo = $request->category_photo;
        $extension = $photo->extension();
        $file_name = uniqid() . '.' . $extension;
        Image::make($photo)->save(public_path('uploads/category/' . $file_name));

        Category::insert([
            'category_name' => $request->category_name,
            'category_photo' => $file_name,
            'slug' => $slug,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('inserted', 'Category inserted successfully!');
    }
    function category_edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.category_edit', [
            'category' => $category,
        ]);
    }
    function category_update(Request $request, $id)
    {
        $photo = $request->category_photo;
        $slug = Str::lower(str_replace('', '-', $request->category_name) . '-' . random_int('200000', '999999'));
        if ($photo == '') {
            Category::find($id)->update([
                'category_name' => $request->category_name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('updated', 'category updated successfully!');
        } else {
            $category = Category::find($id);
            $delete_from = public_path('uploads/category/' . $category->category_photo);
            unlink($delete_from);

            $extension = $photo->extension();
            $file_name = uniqid() . '.' . $extension;
            Image::make($photo)->save(public_path('uploads/category/' . $file_name));

            Category::find($id)->update([
                'category_name' => $request->category_name,
                'category_photo' => $file_name,
                'slug' => $slug,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('updated', 'category updated successfully!');
        }
    }
    function category_delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->category_photo) {
                $delete_from = public_path('uploads/category/' . $category->category_photo);
                if (file_exists($delete_from)) {
                    unlink($delete_from);
                }
            }
            $category->delete();
            return back()->with('deleted', 'category deleted successfully!');
        } else {
            return back()->with('not_found', 'category not found');
        }
    }
}
