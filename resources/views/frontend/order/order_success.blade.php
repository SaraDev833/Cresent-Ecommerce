@extends('frontend.master')
@section('frontend_content')
    <!-- content -->
    <div class="container flex items-center justify-center py-12 mobile-container">
        <div class="md:w-[500px] shadow-md p-6 flex items-center justify-center flex-col w-[400px] rounded-lg">
            <h2 class="mb-2 font-semibold text-gray-700 md:text-xl sm:text-lg">Thanks for your Order!!</h2>
            <p class="mb-6 text-sm text-center text-gray-500 md:mb-8 md:text-lg">Your Order <span
                    class="font-medium text-gray-700 hover:underline">#6w6e653</span> has been received. We will notify you
                via email. Thank you for being with us</p>
            <div class="flex gap-2 button">
                <a href="{{ route('order', Auth::guard('customer')->id()) }}"
                    class="px-3 py-1 text-sm font-semibold text-white bg-red-500 rounded-md shadow-sm hover:bg-red-700 whitespace-nowrap">Track
                    order</a>
                <a href="{{ route('home') }}"
                    class="px-3 py-1 text-sm font-semibold text-red-500 bg-white border rounded-md shadow-sm hover:bg-gray-200 hover:text-red-500 whitespace-nowrap">Return
                    to shopping</a>
            </div>
        </div>

    </div>
    <!-- content -->
@endsection
