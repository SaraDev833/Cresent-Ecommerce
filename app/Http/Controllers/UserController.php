<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{

    function insert_user(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return back()->with('success', 'user added successfully!');
    }

    function edit_profile()
    {
        return view('admin.user.edit_profile');
    }

    function update_profile(Request $request)
    {
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
        ]);
        return back()->with('name_changed', 'Your Name updated successfully!!');
    }

    function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => [
                'required',
                'confirmed',

            ],
            'password_confirmation' => 'required',

        ]);

        if (password_verify($request->current_password, Auth::user()->password)) {
            User::find(Auth::user()->id)->update([
                'password' => $request->password
            ]);
            return back()->with('updated', 'your password updated successfully!');
        } else {
            return back()->with('dismatched', 'Your current password is not correct');
        }
    }

    function update_photo(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'photo' => 'mimes:png,jpg, svg',
            'photo' => 'max:1024'
        ]);

        if (Auth::user()->photo != null) {
            $delete_from = public_path('uploads/users/' . Auth::user()->photo);
            unlink($delete_from);
        }

        $photo = $request->photo;

        $extension = $photo->extension();
        $file_name = uniqid() . '.' . $extension;
        Image::make($photo)->save(public_path('uploads/users/' . $file_name));

        User::find(Auth::user()->id)->update([
            'photo' => $file_name,
        ]);

        return back()->with('image', 'photo updated successfully !!');
    }

    function user_list()
    {
        $users = User::all();
        return view('admin.user.user_list', [
            'users' => $users,
        ]);
    }

    function user_delete($id)
    {

        $user = User::find($id);
        if ($user) {
            if ($user->photo) {
                $delete_from = public_path('uploads/users/' . $user->photo);
                if (file_exists($delete_from)) {
                    unlink($delete_from);
                }
            }
            $user->delete();
            return back()->with('deleted', 'user deleted successfully');
        } else {
            return back()->with('deleted', 'user not found');
        }
    }
}
