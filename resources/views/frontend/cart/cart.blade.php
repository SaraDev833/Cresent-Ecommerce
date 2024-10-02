@extends('frontend.master')
@section('frontend_content')
    <!-- cart content -->
    <div class="container py-20 mobile-container">
        <section class="py-2 ">
            <div class="w-full px-4 md:px-5 lg-6">

                <h2 class="mb-8 text-2xl font-semibold leading-10 text-center md:text-left text-slate-800 title ">Shopping
                    Cart
                </h2>
                <div class="hidden grid-cols-2 py-6 lg:grid">
                    <div class="text-xl font-normal leading-8 text-slate-600">Product</div>
                    <p class="flex items-center justify-between text-xl font-normal leading-8 text-slate-600">
                        <span class="w-full max-w-[200px] text-center">Price</span>
                        <span class="w-full max-w-[260px] text-center">Quantity</span>
                        <span class="w-full max-w-[200px] text-center">Total</span>
                    </p>
                </div>

                @php
                    $sub = 0;
                @endphp
                @forelse ($carts as $cart)
                    <form action="{{ route('update.cart') }}" method="POST">
                        @if (session('error'))
                            <div class="w-full px-3 py-2 my-3 text-sm font-semibold rounded-lg bg-emerald-200">
                                {{ session('error') }}</div>
                        @endif
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 min-[550px]:gap-6 border-t border-gray-200 py-6 cart-item"
                            data-price={{ App\Models\Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->after_discount_price }}>
                            <div
                                class="flex items-center flex-col min-[550px]:flex-row gap-3 min-[550px]:gap-7 w-full max-xl:justify-center max-xl:max-w-xl max-xl:mx-auto ">
                                <div class="img-box"><img
                                        src="{{ asset('uploads/products/preview/' . $cart->rel_to_product->preview) }}"
                                        alt="jacket" class="xl:w-[140px] rounded-xl object-cover w-[250px] md:w-[200px]">
                                </div>
                                <div class="flex flex-col items-center w-full max-w-sm sm:items-start pro-data">
                                    <h5
                                        class="font-semibold text-xl leading-8 text-black max-[550px]:text-center text-center">
                                        {{ $cart->rel_to_product->product_name }}
                                    </h5>
                                    @php
                                        $reviews = App\Models\OrderProduct::where(
                                            'product_id',
                                            $cart->rel_to_product->id,
                                        )
                                            ->whereNotNull('reviews')
                                            ->get();
                                        $stars = App\Models\OrderProduct::where('product_id', $cart->rel_to_product->id)
                                            ->whereNotNull('reviews')
                                            ->sum('stars');
                                        $avg = 0;
                                        if ($reviews->count() != 0) {
                                            $avg = $stars / $reviews->count();
                                        }
                                    @endphp
                                    @if ($reviews->count() != 0)
                                        <div class="text-yellow-500 min-[550px]:text-center stars ">
                                            @for ($i = 1; $i < $avg; $i++)
                                                <i class="fa-solid fa-star"></i>
                                            @endfor
                                        </div>
                                    @else
                                        <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }}
                                            review</div>
                                    @endif


                                </div>
                            </div>
                            <div
                                class="flex items-center flex-col min-[550px]:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-5">
                                <h6
                                    class="font-manrope font-bold text-2xl leading-9 text-slate-600 w-full max-w-[170px] text-center">

                                    ${{ App\Models\Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->after_discount_price }}
                                </h6>
                                <div class="flex items-center justify-center w-full mx-auto">
                                    <div class="flex items-center space-x-2">
                                        <button id="decrease"
                                            class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring decrease"
                                            type="button">
                                            -
                                        </button>
                                        <input type="number" id="quantity"
                                            class="px-3 py-1 text-center border border-gray-300 rounded quantity w-14"
                                            value="{{ $cart->quantity }}" min="1"
                                            name="quantity[{{ $cart->id }}]">
                                        <button id="increase"
                                            class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring increase"
                                            type="button">
                                            +
                                        </button>
                                    </div>

                                </div>
                                <h6 class="text-slate-600 font-manrope font-bold text-2xl leading-9 w-full max-w-[170px] text-center subtotal"
                                    id="subtotal">
                                    ${{ App\Models\Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->after_discount_price * $cart->quantity }}
                                </h6>
                                <a href="{{ route('cart.delete', $cart->id) }}"><i
                                        class="text-xl text-red-500 fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                        @php
                            $sub +=
                                App\Models\Inventory::where('product_id', $cart->product_id)
                                    ->where('color_id', $cart->color_id)
                                    ->where('size_id', $cart->size_id)
                                    ->first()->after_discount_price * $cart->quantity;
                        @endphp
                    @empty
                        No product found!!
                @endforelse
                <div class="flex justify-end">
                    <button type="submit"
                        class="flex items-center justify-center col-span-2 px-3 py-2 text-sm font-semibold text-center text-white transition-all duration-500 bg-red-500 rounded-md lg:col-span-1 hover:bg-red-700 whitespace-nowrap">Update
                        Cart</button>
                </div>
                </form>
                @if ($coupon_name != '')
                    @if ($msg)
                        <div class="px-4 py-3 font-semibold text-black bg-red-200 w-[350px] rounded-md">{{ $msg }}
                        </div>
                    @endif
                @endif
                <form action="{{ route('cart') }}" method="GET">
                    @csrf
                    <div class="grid justify-between grid-cols-6 gap-5 py-4 ">
                        @php
                            if ($coupon_type == 1) {
                                if ($sub > $min_purchase) {
                                    $discount = round(($sub * $amount) / 100);
                                } else {
                                    $discount = 0;
                                    $msg = 'min purchase' . $min_purchase;
                                }
                            } else {
                                if ($sub > $min_purchase) {
                                    $discount = $amount;
                                } else {
                                    $discount = 0;
                                    $msg = 'min purchase' . $min_purchase;
                                }
                            }
                        @endphp


                        <input type="text"
                            class="h-10 col-span-4 py-1 border rounded-md outline-none lg:col-span-2 border-slate-600 ring-0 focus:ring-red-500 focus:ring-1"
                            name="coupon_name">
                        <button
                            class="flex items-center justify-center col-span-2 px-3 py-2 text-sm font-semibold text-center text-white transition-all duration-500 bg-red-500 rounded-md lg:col-span-1 hover:bg-red-700 whitespace-nowrap">Add
                            Coupon</button>
                    </div>
                </form>
                <div class="w-full p-6 mb-8 bg-gray-50 rounded-xl max-lg:max-w-xl max-lg:mx-auto">
                    <div class="flex items-center justify-between w-full mb-6">
                        <p class="text-xl font-normal leading-8 text-gray-500">Sub Total</p>
                        <h6 class="text-xl font-semibold leading-8 text-gray-900">${{ $sub }}</h6>
                    </div>
                    <div class="flex items-center justify-between w-full pb-6 border-b border-gray-200">
                        <p class="text-xl font-normal leading-8 text-gray-500">Discount</p>
                        <h6 class="text-xl font-semibold leading-8 text-gray-900">${{ $discount }}</h6>
                    </div>
                    <div class="flex items-center justify-between w-full py-6">
                        <p class="text-2xl font-medium leading-9 text-gray-900 font-manrope">Total</p>
                        <h6 class="text-2xl font-medium leading-9 text-red-500 font-manrope">${{ $sub + $discount }}</h6>
                    </div>

                </div>
                @php
                    session([
                        'discount' => $discount,
                        'total' => $sub + $discount,
                    ]);

                @endphp
                <div class="flex flex-col items-center justify-center gap-3 mt-8 sm:flex-row">

                    <a href="{{ route('checkout') }}"
                        class="rounded-md w-full max-w-[280px] py-3 text-center justify-center items-center bg-red-500 font-semibold text-sm text-white flex transition-all duration-500 hover:bg-red-600">Continue
                        to Checkout

                    </a>
                </div>

            </div>
        </section>

    </div>
@endsection
@section('footer_content')
    <script>
        document.getElementById('increase').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });

        document.getElementById('decrease').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        document.querySelectorAll('.cart-item').forEach(item => {
            const decreaseButton = item.querySelector('.decrease');
            const increaseButton = item.querySelector('.increase');
            const quantityInput = item.querySelector('.quantity');
            const subTotal = item.querySelector('.subtotal');
            const price = parseFloat(item.dataset.price);

            function updateSubtotal() {
                const quantity = parseInt(quantityInput.value);
                const subtotalValue = Math.round(price * quantity);
                subTotal.innerText = `$${subtotalValue.toFixed(2)}`;
            }

            decreaseButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = --quantity;
                    updateSubtotal();
                }
            });

            increaseButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                quantityInput.value = ++quantity;
                updateSubtotal();
            });

            // Initial subtotal calculation
            updateSubtotal();
        });
    </script>
@endsection
