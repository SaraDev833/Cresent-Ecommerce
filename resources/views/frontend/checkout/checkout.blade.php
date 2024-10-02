@extends('frontend.master')
@section('frontend_content')
    <!-- checkout content -->
    <div class="container py-10 mobile-container">

        <ol class="flex items-center justify-between w-full lg:w-2/4">
            <li
                class="flex items-center gap-2 after:content[''] lg:after:w-full after:h-[1px] after:bg-slate-400 lg:w-10/12 md:after:w-full md:w-2/6 sm:after:w-full sm:w-2/6">
                <i class="text-sm antialiased text-red-500 fa-regular fa-circle-check"></i>
                <p class="text-lg antialiased font-bold leading-snug text-red-500">Cart</p>

            </li>
            <li
                class="flex items-center gap-2 after:content[''] lg:after:w-full after:h-[1px] after:bg-slate-400 lg:w-10/12 md:after:w-full md:w-2/6 sm:after:w-full sm:w-2/6">
                <i class="text-sm antialiased text-red-500 fa-regular fa-circle-check"></i>
                <p class="text-lg antialiased font-bold text-red-500 leading-sung">Checkout</p>

            </li>
            <li class="flex items-center gap-2 after:content[''] lg:after:w-full after:h-[1px] after:bg-slate-400 ">
                <i class="text-sm antialiased text-slate-500 fa-regular fa-circle-check"></i>
                <p class="text-lg antialiased font-bold whitespace-nowrap text-slate-500 leading-sung">Place Order</p>

            </li>
        </ol>
        @if (session('success'))
            <div class="p-4 mt-4 rounded-md text-slate-700 w-[300px]" style="background-color: rgb(185, 203, 185)">
                {{ session('success') }}</div>
        @endif
        <form action="{{ route('order.store') }}" method="POST" class="flex flex-col w-full mt-10 gap-7 lg:flex-row">
            @csrf
            <div class="flex flex-col flex-wrap w-full lg:w-3/5">
                <h3 class="text-2xl font-semibold sm:text-xl text-slate-700 my-7">Delivery Details</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Your Name</label>
                        <input type="text" name="name" placeholder="Your name.."
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            value="{{ Auth::guard('customer')->user()->name }}">
                        @error('name')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for=""
                            class="mb-3 text-xl font-semibold text-slate-700 after:content-['*'] after:text-red-50 after:ml-0.5">Your
                            Email *</label>
                        <input type="email" name="email" placeholder="Your email.."
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            value="{{ Auth::guard('customer')->user()->email }}">
                        @error('email')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Country *</label>
                        <select name="country_id" id="country_id"
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500">
                            @foreach ($countries as $country)
                                <option {{ Auth::guard('customer')->user()->country_id == $country->id ? 'selected' : '' }}
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach


                        </select>
                        @error('country_id')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Your city</label>
                        <select name="city_id" id="city_id"
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500">
                            @if (Auth::guard('customer')->user()->city_id != null)
                                <option value="{{ Auth::guard('customer')->user()->city_id }}">
                                    {{ Auth::guard('customer')->user()->rel_to_city->name }}</option>
                            @else
                                <option value=""></option>
                            @endif
                        </select>
                        @error('city_id')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Phone number</label>
                        <input type="number" placeholder="Your  number.."
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            name="phone">
                        @error('phone')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Your company</label>
                        <input type="text" placeholder="company name.."
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            name="company">
                        @error('company')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Your Address</label>
                        <textarea name="address"
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            name="address"></textarea>
                        @error('address')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="" class="mb-3 text-xl font-semibold text-slate-700">Your Notes</label>
                        <textarea
                            class="w-full px-2 py-3 mt-3 border rounded outline-none border-slate-600 focus:ring-1 focus:ring-red-500 placeholder:text-slate-500"
                            name="notes"></textarea>
                        @error('notes')
                            <span class="text-sm font-semibold text-red-600">* {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-7">
                    <h3 class="text-2xl font-semibold sm:text-xl text-slate-700 my-7">Payment methods & Delivery </h3>
                    <div class="flex flex-col gap-4 shadow-lg md:flex-row md:gap-4">
                        <div class="flex items-center justify-start gap-4 px-6 py-3 border rounded shadow-sm">
                            <input type="radio" id="payment" name="payment" value="1"
                                class="w-3 h-3 text-blue-600 form-radio ">
                            <div class="flex flex-col">
                                <label for="payment" class="text-lg font-semibold text-slate-700">Stripe</label>
                                <p class="text-sm font-semibold text-slate-400 whitespace-nowrap">Pay with Stripe</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-start gap-4 px-6 py-3 border rounded shadow-sm">
                            <input type="radio" id="payment" name="payment" value="2"
                                class="w-3 h-3 text-blue-600 form-radio ">
                            <div class="flex flex-col">
                                <label for="payment" class="text-lg font-semibold text-slate-700 whitespace-nowrap">Cash on
                                    delivery</label>
                                <p class="text-sm font-semibold text-slate-400">Pay on arrival</p>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center gap-2 px-6 py-3 rounded">
                            <h3 class="my-1 text-lg font-semibold text-slate-700 whitespace-nowrap">Delivery Charge</h3>
                            @foreach ($charges as $charge)
                                <div class="flex items-center gap-3">
                                    <input type="radio" id="charge1" checked class="w-3 h-3 text-blue-600 form-radio"
                                        data-charge="{{ $charge->charge }}" name="delivery_charge"
                                        onchange="updateDeliveryCharge()">
                                    <label for="charge1"
                                        class="text-sm font-semibold text-slate-400">{{ $charge->location }}:
                                        ${{ $charge->charge }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex flex-col flex-wrap w-full gap-4 lg:pt-[100px] lg:w-2/5 pt-9">

                <div class="flex flex-col gap-4 p-4 mt-5 border rounded shadow-sm">
                    <div class="flex justify-between pt-5">
                        <h3 class="text-xl font-semibold text-slate-500">Subtotal</h3>
                        <p class="text-xl font-semibold text-slate-800" id="subtotal">${{ session('total') }}
                    </div>

                    <div class="flex justify-between pt-5 border-t">
                        <h3 class="text-xl font-semibold text-slate-500">Delivery charge</h3>
                        <p class="text-xl font-semibold text-slate-800" id="delivery_charge">$0</p>
                    </div>

                    <div class="flex justify-between pt-5 border-t border-black">
                        <h3 class="text-xl font-semibold text-slate-500">Total</h3>
                        <p class="text-xl font-semibold text-slate-800" id="total">${{ session('total') }}</p>
                        <!-- Set to subtotal initially -->
                    </div>

                    <input type="hidden" id="total_price" name="total_price" value="{{ session('total') }}">
                    <input type="hidden" id="delivery_charge_value" name="delivery_charge" value="0">
                    <input type="hidden" class="form-control" name="customer_id"
                        value="{{ Auth::guard('customer')->id() }}">

                    <div class="flex items-center justify-end pt-5 pb-5">
                        <button type="submit"
                            class="px-4 py-3 text-sm font-semibold text-center text-white bg-red-500 border rounded-md">Proceed
                            to Payment</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- footer -->


    <script src="{{ asset('frontend') }}/index.js"></script>
    </body>

    </html>
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
                url: '/get/city',
                data: {
                    'country_id': country_id
                },
                success: function(data) {
                    $('#city_id').html(data);
                }
            })

        })
    </script>
    <script>
        function updateDeliveryCharge() {
            const selectedRadio = document.querySelector('input[name="delivery_charge"]:checked');
            const selectedCharge = selectedRadio ? Math.round(parseInt(selectedRadio.getAttribute('data-charge'))) : 0;
            $('#delivery_charge').innerText = `$${selectedCharge}`;

            const deliveryChargeElement = document.getElementById('delivery_charge');
            deliveryChargeElement.innerText = `$${selectedCharge}`;
            const subtotal = Math.round(parseFloat("{{ session('total') }}"));
            const totalPriceElement = document.getElementById('total');
            const total = subtotal + selectedCharge;
            totalPriceElement.innerText = `$${total}`;
            document.getElementById('total_price').value = total.toFixed(2);
            document.getElementById('delivery_charge_value').value = selectedCharge.toFixed(2);
        }
    </script>
@endsection
