@extends('frontend.master')
@section('frontend_content')
    <!-- order page -->
    <div class="container py-10 shadow mobile-container">
        @forelse ($orders as $order)
            <div class="order-1 pb-5">
                <div
                    class="flex flex-col justify-start gap-4 px-6 py-6 border border-gray-200 rounded lg:flex-row lg:justify-between lg:items-center">
                    <div class="data">
                        <p class="text-xl font-semibold text-slate-700 ">Order ID : <span
                                class="text-xl font-semibold text-slate-500 ">#{{ $order->order_id }}</span></p>
                        <p class="text-xl font-semibold text-slate-700 ">Order date : <span
                                class="text-xl font-semibold text-slate-500 ">{{ $order->created_at->format('d-m-y') }}</span>
                        </p>
                    </div>
                    <button type="button"
                        class="px-2 py-2 text-sm font-semibold text-white bg-red-500 rounded-full lg:py-2">Track your
                        order</button>
                </div>
                <div
                    class="flex flex-col flex-wrap items-center justify-center w-full gap-2 border shadow-md lg:flex-row lg:justify-start">
                    <div class="w-full lg:w-1/4">
                        <img src="{{ asset('uploads/products/preview/' . $order->rel_to_product->preview) }}"
                            class="w-full border shadow-md lg:w-52 lg:h-52 aspect-auto" alt="">
                    </div>
                    <div
                        class="flex flex-col items-start justify-center w-full gap-3 px-4 pt-10 pb-10 pl-12 lg:w-2/3 lg:flex-row lg:justify-between lg:pl-0 lg:pt-0 lg:pb-0">
                        <div class="flex flex-col gap-4 information md:gap-2">
                            <h3 class="text-xl font-semibold text-slate-800 ">{{ $order->rel_to_product->product_name }}
                            </h3>
                            <span class="text-lg font-semibold text-slate-500">By Cresent</span>
                            <div class="flex flex-row items-center justify-start gap-2">
                                <p class="text-lg font-semibold text-slate-700 ">Size: <span
                                        class="text-lg font-semibold text-slate-500">{{ $order->rel_to_size->size_name }}</span>
                                </p>
                                <p class="text-lg font-semibold text-slate-700 ">Qty: <span
                                        class="text-lg font-semibold text-slate-500">{{ $order->quantity }}</span></p>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-center gap-4 lg:flex-col">
                            <p class="text-lg font-semibold text-slate-700">Price</p>

                            <span>${{ App\Models\Inventory::where('product_id', $order->product_id)->where('color_id', $order->color_id)->where('size_id', $order->size_id)->first()->after_discount_price * $order->quantity }}</span>
                        </div>
                        <div class="flex items-center justify-center gap-4 lg:flex-col">
                            <p class="text-lg font-semibold text-slate-700">Status</p>
                            @foreach (App\Models\Order::where('order_id', $order->order_id)->get() as $order)
                                @if ($order->status == 1)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold text-green-600 rounded-full bg-emerald-200 whitespace-nowrap">Placed</span>
                                @elseif ($order->status == 2)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold text-purple-600 bg-purple-200 rounded-full whitespace-nowrap">Processing</span>
                                @elseif ($order->status == 3)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold rounded-full text-sky-600 bg-sky-200 whitespace-nowrap">Shipping</span>
                                @elseif ($order->status == 4)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold text-pink-600 bg-pink-200 rounded-full whitespace-nowrap">Ready
                                        To Deliver</span>
                                @elseif ($order->status == 5)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold text-yellow-600 bg-yellow-200 rounded-full whitespace-nowrap">Delivered</span>
                                @elseif ($order->status == 0)
                                    <span
                                        class="px-2 py-1 text-sm font-semibold text-red-600 bg-red-200 rounded-full whitespace-nowrap">Cancelled</span>
                                @endif
                            @endforeach
                        </div>
                        <div class="flex items-center justify-center gap-4 lg:flex-col">
                            <p class="text-lg font-semibold text-slate-700 whitespace-nowrap ">Total</p>
                            <span
                                class="text-lg font-semibold rounded-full text-slate-500 whitespace-nowrap">${{ App\Models\Order::where('order_id', $order->order_id)->first()->total }}</span>
                        </div>
                        <div class="flex items-center justify-center gap-4 lg:flex-col">
                            <p class="text-lg font-semibold text-slate-700 whitespace-nowrap">Cancel Order</p>
                            @if (App\Models\Order::where('order_id', $order->order_id)->first()->status == 4)
                                <a class="px-3 py-1 text-white bg-red-400 rounded " disabled>Cancel</a>
                            @else
                                <a href="{{ route('order.delete', $order->order_id) }}"
                                    class="px-3 py-1 text-white bg-red-500 rounded ">Cancel</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span class="block pt-10 text-xl text-center">No Order Found!!</span>
        @endforelse

    </div>

    <!-- order page -->

@endsection
