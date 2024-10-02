<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules\Unique;

class BannerController extends Controller
{
    function banner()
    {
        $banners = Banner::all();
        return view('admin.banner.banner', [
            'banners' => $banners,
        ]);
    }
    function add_banner(Request $request)
    {
        $image = $request->banner;
        $extension = $image->extension();
        $file_name = uniqid() . '.' . $extension;
        Image::make($image)->save(public_path('uploads/banner/' . $file_name));

        Banner::insert([

            'small_text' => $request->small_text,
            'banner_image' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function banner_delete($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $delete_from = public_path('uploads/banner/' . $banner->banner_image);
            if (file_exists($delete_from)) {
                unlink($delete_from);
            }
        }

        $banner->delete();
        return back();
    }
}
