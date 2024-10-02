<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\PassReset;
use App\Notifications\PasswordReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PassResentController extends Controller
{
    function pass_reset_req()
    {
        $categories = Category::all();
        return view('frontend.password_reset.pass_reset_form', [
            'categories' => $categories,
        ]);
    }

    function pass_reset_email(Request $request)
    {
        // Validate the request to ensure 'email' is provided
        $request->validate([
            'email' => 'required|email',
        ]);


        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            PassReset::where('customer_id', $customer->id)->delete();


            $info = PassReset::create([
                'token' => uniqid(),
                'customer_id' => $customer->id,
                'created_at' => Carbon::now(),
            ]);


            Notification::send($customer, new PasswordReset($info));

            return back()->with('success', 'Password reset link has been sent to your email');
        } else {
            return back()->with('invalid', 'Your email is invalid');
        }
    }
    function new_pass_req($token)
    {
        $categories = Category::all();
        $info = PassReset::where('token', $token)->first();
        if ($info) {
            return view('frontend.password_reset.new_password_form', [
                'token' => $token,
                'categories' => $categories,
            ]);
        } else {
            abort('404');
        }
    }
    function new_pass_update(Request $request, $token)
    {
        $info = PassReset::where('token', $token)->first();
        if ($token) {
            if ($info->created_at->diffIndays(Carbon::now()) < 1) {
                $request->validate([
                    'password' => 'required | confirmed',
                    'password_confirmation' => 'required',

                ]);

                Customer::find($info->customer_id)->update([
                    'password' => bcrypt($request->password),
                    'updated_at' => Carbon::now(),
                ]);
                PassReset::find($info->id)->delete();
                return redirect()->route('customer.login')->with('success', 'password reset successfully!');
            } else {
                return back()->with('expired', 'Link expired');
            }
        } else {
            abort('404');
        }
    }
}
