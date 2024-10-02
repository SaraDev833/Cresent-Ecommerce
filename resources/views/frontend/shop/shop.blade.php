@extends('frontend.master')
@section('frontend_content')
    <!-- category and product section -->
    <section class="container flex gap-8 mt-8 mobile-container">
        <aside class="sticky top-0 flex-col hidden max-h-screen lg:flex lg:w-1/4">
            <div class="overflow-y-auto aside-section " id="aside">
                <div class="flex flex-col w-full gap-4 p-4 bg-white border shadow-lg categories rounded-xl">
                    <h1 class="pb-2 text-xl font-semibold bg-white border-b-2">Categories</h1>
                    @foreach ($categories as $category)
                        <div class="pb-3 text-lg font-semibold text-gray-600 border-b">
                            <details>
                                <summary>
                                    <div class="flex items-center gap-3 cursor-pointer">
                                        <img src="{{ asset('uploads/category/' . $category->category_photo) }}" alt=""
                                            class="w-4 h-4">
                                        <span>{{ Str::limit($category->category_name, 22, '..') }}</span>
                                    </div>
                                </summary>
                                @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                    <div class="flex items-center justify-between font-normal">
                                        <form action="{{ route('search') }}" method="GET">
                                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                                            <input type="hidden" name="sub_id" value="{{ $subcategory->id }}">
                                            <button type="submit"
                                                class="text-slate-700 hover:underline">{{ $subcategory->subcategory_name }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            </details>
                        </div>
                    @endforeach
                </div>
                @php

                    $productsWithRatings = [];

                    foreach ($all_products as $product) {
                        $reviews = App\Models\OrderProduct::where('product_id', $product->id)
                            ->whereNotNull('reviews')
                            ->get();
                        $review_count = $reviews->count();
                        $average_rating = $review_count > 0 ? $reviews->sum('stars') / $review_count : 0;

                        if ($review_count > 0) {
                            $productsWithRatings[] = [
                                'product' => $product,
                                'average_rating' => $average_rating,
                            ];
                        }
                    }

                    usort($productsWithRatings, function ($a, $b) {
                        return $b['average_rating'] <=> $a['average_rating'];
                    });
                    $productsWithRatings = collect($productsWithRatings);
                @endphp

                <div class="flex flex-col items-start justify-start gap-4 mt-10 best-sellers">
                    <h2 class="text-lg font-semibold">BEST SELLERS</h2>
                    @if ($productsWithRatings->every(fn($item) => $item['average_rating'] == 0))
                        <span class="text-sm font-semibold text-slate-600">No review on any product Yet</span>
                    @else
                        @foreach ($productsWithRatings->take(5) as $item)
                            @php
                                $product = $item['product'];
                                $average_rating = $item['average_rating'];
                            @endphp
                            <div class="flex items-center justify-between gap-3">
                                <div class="w-20 h-20 p-2 border rounded-md shadow-lg bg-gray-300/20">
                                    <img src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                        class="w-full h-full" alt="{{ $product->name }}">
                                </div>
                                <div class="text">
                                    <h4 class="text-gray-900">{{ $product->product_name }}</h4>
                                    <div class=" stars" style="color: gold">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fa-solid fa-star{{ $i < round($average_rating) ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <s class="text-gray-500">${{ $product->rel_to_inventory->first()->price }}</s>
                                        <strong>${{ $product->rel_to_inventory->first()->after_discount_price }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </aside>
        <!-- product section -->
        <div class="product-section lg:w-3/4 pb-[100px] ">
            <div class="flex flex-col items-center justify-between w-full gap-3 sm:flex-row">
                <div class="flex-col">
                    @if (isset($search_item) && $search_item !== '')
                        <p class="text-sm font-semibold text-slate-700">{{ $products->count() }} items found for
                            "{{ $search_item }}"</p>
                    @elseif (isset($subcategory_id) && $subcategory_id !== '')
                        <p class="text-sm font-semibold text-slate-700">{{ $products->count() }} items found for
                            "{{ App\Models\Subcategory::find($subcategory_id)->subcategory_name }}"</p>
                    @endif

                </div>
                <div class="" style="display: ruby;">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="hidden" name="category_id" value="{{ $category_id }}">
                        <input type="hidden" name="sub_id" value="{{ $subcategory_id }}">
                        <input type="hidden" name="search" value="{{ $search_item }}">
                        <ul class="flex items-center px-3 py-2 border rounded-lg shadow bg-via-gray-500">
                            <li class="px-2 text-sm font-semibold whitespace-nowrap">Short by :</li>
                            <li>
                                <select name="short" id="" class="text-sm font-normal border-0"
                                    onchange="this.form.submit()">
                                    <option value="">Sort by</option>
                                    <option value="high_to_low" {{ request('short') === 'high_to_low' ? 'selected' : '' }}>
                                        Price high to low</option>
                                    <option value="low_to_high" {{ request('short') === 'low_to_high' ? 'selected' : '' }}>
                                        Price low to high</option>>
                                </select>
                            </li>
                        </ul>
                    </form>
                    <div class="hidden ml-1 view md:flex">
                        <a href="#" id="view" class="text-lg font-semibold text-slate-700">View : <i
                                class="text-red-500 fa-solid fa-list text-kg"></i></a>
                    </div>
                </div>

            </div>
            <div
                class="grid w-full grid-cols-1 gap-4 pt-10 product lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 product_togg">


                @foreach ($products as $product)
                    <div class="flex flex-col transition-all shadow hover:border hover:shadow-lg">
                        <a href="{{ route('view.product', $product->slug) }}"> <img
                                src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                class="w-full aspect-square" alt=""></a>
                        <div class="flex flex-col p-3 text">
                            <a href="{{ route('view.product', $product->slug) }}">
                                @php
                                    $product_length = $product->product_name;
                                @endphp
                                <p class="text-lg font-semibold text-slate-700 ">
                                    {{ $product_length >= 22 ? Str::substr($product_length, 0, 22) . '...' : $product->product_name }}
                                </p>
                            </a>
                            <span
                                class="text-lg font-normal text-red-500">${{ $product->rel_to_inventory->first()->after_discount_price }}</span>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-normal text-slate-700">{{ $product->discount }}%off</span>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex-col hidden w-full gap-4 pt-10 " id="product_wide">
                @foreach ($products as $product)
                    <div class="product-grid">
                        <div class="flex w-full gap-5 border">
                            <div class="w-[25%]">
                                <a href="{{ route('view.product', $product->slug) }}"> <img
                                        src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                        class="object-cover rounded-md aspect-square" alt=""></a>
                            </div>
                            <div class="flex flex-col justify-center gap-4 w-[40%]">
                                <a href="{{ route('view.product', $product->slug) }}">
                                    <p class="text-lg font-semibold text-slate-700 ">{{ $product->product_name }}</p>
                                </a>
                                {{-- @php
                                $reviews = App\Models\OrderProduct::where('product_id', $product->id)
                                    ->whereNotNull('reviews')
                                    ->get();
                                $stars = App\Models\OrderProduct::where('product_id', $product->id)
                                    ->whereNotNull('reviews')
                                    ->sum('stars');
                                $avg = 0;
                                if ($reviews->count() != 0) {
                                    $avg = $stars / $reviews->count();
                                }
                            @endphp --}}
                                {{-- <div class="flex flex-col items-start justify-start">
                                    @if ($reviews->count() != 0)
                                        <div class=" stars" style="color:gold">
                                            @for ($i = 1; $i <= $avg; $i++)
                                                <i class="fa-solid fa-star star"></i>
                                            @endfor
                                        @else
                                            <span class="text-sm text-slate-500">No reviews yet!</span>
                                    @endif

                                </div> --}}
                                <ul>
                                    <li><span class="text-slate-700 font-sm">Brand:</span> <span
                                            class="text-sm text-slate-500">{{ $product->rel_to_brand->brand_name }}</span>
                                    </li>
                                    <li><span class="text-slate-700 font-sm">Quantity:</span> <span
                                            class="text-sm text-slate-500">{{ $product->rel_to_inventory->first()->quantity }}</span>
                                    </li>


                                </ul>
                            </div>
                            <div class="w-[30%] flex flex-col justify-center items-start gap-5">
                                <span
                                    class="text-lg font-semibold text-red-500">${{ $product->rel_to_inventory->first()->after_discount_price }}</span>
                                <span class="text-lg font-semibold text-slate-700">{{ $product->discount }}%off</span>
                            </div>
                        </div>


                    </div>
                @endforeach

            </div>
        </div>

        </div>

    </section>

    <!-- category and product section -->
@endsection
