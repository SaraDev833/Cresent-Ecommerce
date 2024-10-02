@extends('frontend.master')
@section('frontend_content')
    <div class="container py-10 mobile-container ">
        <div class="flex flex-col gap-4 lg:flex-row">
            <div class="flex flex-col gap-5 lg:w-[20%] w-full">
                <div class="flex flex-col px-2 py-3 border-b border-gray-300 rounded-xl">
                    <h3 class="text-lg font-semibold text-slate-800">Manage My account</h3>
                    <a href="{{ route('customer.profile') }}" class="text-sm font-semibold text-red-600">My Profile</a>
                </div>
                <div class="flex flex-col px-2 py-3 border-b border-gray-300 rounded-xl">
                    <h3 class="text-lg font-semibold text-slate-800">My Orders</h3>

                    <a href="{{ route('order', Auth::guard('customer')->id()) }}"
                        class="text-sm font-semibold text-red-600">Orders</a>


                </div>
                <div class="flex flex-col px-2 py-3 border-b border-gray-300 rounded-xl">
                    <h3 class="text-lg font-semibold text-slate-800">My wishlist</h3>
                    <a href="{{ route('wishlist') }}" class="text-sm font-semibold text-red-600">Wishlist</a>
                </div>
            </div>
            <div class="lg:w-[70%] w-full border-gray-300 border-2 rounded-md p-4">
                @if (session('updated'))
                    <div class="p-4 text-white rounded-md" style="background-color: rgb(155, 169, 155)">
                        {{ session('updated') }}</div>
                @endif
                @if (session('user'))
                    <div class="p-4 rounded-md text-slate-700 " style="background-color: rgb(155, 169, 155)">
                        {{ session('user') }}</div>
                @endif
                <form action="{{ route('customer.information') }}" method="POST">
                    @csrf
                    <div class="grid flex-wrap grid-cols-1 gap-4 px-3 py-5 md:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-lg font-semibold text-slate-600">Name</label>
                            <input type="text"
                                class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                placeholder="Your name" value="{{ Auth::guard('customer')->user()->name }}" name="name">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-lg font-semibold text-slate-600">Email *</label>
                            <input type="email"
                                class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                placeholder="Your email" value="{{ Auth::guard('customer')->user()->email }}"
                                name="email">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="" class="text-lg font-semibold text-slate-600">Country</label>
                            <select name="country" class="px-3 py-2 rounded-lg outline-none border-1 ring-1 ring-slate-400"
                                id="country_id">
                                @foreach ($countries as $country)
                                    <option
                                        {{ Auth::guard('customer')->user()->country_id == $country->id ? 'selected' : '' }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-lg font-semibold text-slate-600">City</label>
                            <select name="city" class="px-3 py-2 rounded-lg outline-none border-1 ring-1 ring-slate-400"
                                id="city_id">
                                @if (Auth::guard('customer')->user()->city_id != null)
                                    <option value="{{ Auth::guard('customer')->user()->city_id }}">
                                        {{ Auth::guard('customer')->user()->rel_to_city->name }}</option>
                                @else
                                    <option value=""></option>
                                @endif
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="" class="text-lg font-semibold text-slate-600">Phone</label>
                            <input type="number"
                                class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                placeholder="Phone " value="" name="phone">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="" class="text-lg font-semibold text-slate-600">Address</label>
                            <textarea name="address" rows="2" class="border rounded-lg outline-none ring-1 ring-slate-400 " id=""></textarea>
                        </div>


                    </div>
                    <fieldset class="mb-[20px] px-[20px] py-[40px] border-2 border-gray-300 rounded-md">
                        <legend class="px-3 text-xl font-semibold text-slate-700">Password change </legend>
                        <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2">
                            <div class="flex flex-col gap-2 mb-3">
                                <label for="" class="text-lg font-semibold text-slate-600 ">Current Password <span
                                        class="text-sm font-normal text-slate-500">(Leave blank to leave
                                        unchanged)</span></label>
                                <input type="password"
                                    class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                    placeholder="Current Password" value="" name="current_password">
                                @error('current_password')
                                    <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                                @enderror
                                @if (session('current_password'))
                                    <div class="text-sm font-semibold text-red-500">{{ session('current_password') }}</div>
                                @endif
                            </div>
                            <div class="flex flex-col gap-2 mb-3">
                                <label for="" class="text-lg font-semibold text-slate-600 ">New Password<span
                                        class="text-sm font-normal text-slate-500">(Leave blank to leave
                                        unchanged)</span></label>
                                <input type="password"
                                    class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                    placeholder="New Password" value="" name="password">
                                @error('password')
                                    <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex flex-col gap-2 mb-3">
                                <label for="" class="text-lg font-semibold text-slate-600 ">Confirm Password
                                    Password<span class="text-sm font-normal text-slate-500">(Leave blank to leave
                                        unchanged)</span></label>
                                <input type="password"
                                    class="px-3 py-2 rounded-lg outline-none border-1 placeholder:text-slate-500 ring-1 ring-slate-400"
                                    placeholder="Current Password" value="" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="text-sm font-semibold text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                    </fieldset>
                    <div class="flex justify-end mt-3">
                        <button class="px-4 py-2 font-semibold text-white bg-red-500 rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    </div>
@endsection
@section('footer_content')
    <script>
        $('#country_id').change(function() {
            var country_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getcity',
                data: {
                    'country_id': country_id
                },
                success: function(data) {
                    $('#city_id').html(data);
                }
            })

        })
    </script>
@endsection
