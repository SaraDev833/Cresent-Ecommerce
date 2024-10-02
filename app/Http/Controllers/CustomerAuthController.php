<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    function customer_login()
    {
        return view('frontend.customer.login');
    }
    function customer_register()
    {
        return view('frontend.customer.register');
    }
    function customer_register_post(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                'confirmed',
            ],
            'password_confirmation' => 'required',
        ]);
        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        // if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect()->route('index');
        // }
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        };
    }
    function customer_login_post(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Customer::where('email', $request->email)->exists()) {
            $remember = $request->has('remember');
            if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                return redirect()->route('home');
            } else {
                return back()->with('pass_error', 'Incorrect Pasword!!');
            }
        } else {
            return back()->with('exist', 'Email does not exist');
        }
    }
    function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }
    function customer_profile()
    {
        $categories = Category::all();
        $countries = Country::all();


        return view('frontend.customer.customer_profile', [
            'categories' => $categories,
            'countries' => $countries,


        ]);
    }
    function get_city(Request $request)
    {
        $string = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $string .= ' <option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $string;
    }
    function customer_information(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $user = Customer::find($userId);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

        if ($request->current_password != null) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);


            if (password_verify($request->current_password, $user->password)) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country_id' => $request->country,
                    'city_id' => $request->city,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'password' => bcrypt($request->password),
                ]);

                return back()->with('updated', 'Updated successfully!');
            } else {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
        } else {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'country' => 'required|exists:countries,id',
                'city' => 'required|exists:cities,id',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'country_id' => $request->country,
                'city_id' => $request->city,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            return back()->with('updated', 'Updated successfully!');
        }
    }
}
