@extends('frontend.master')
<style>
    .swiper-scrollbar::-webkit-scrollbar {
        width: 7px !important;
        height: 5px !important;
    }

    .swiper-scrollbar::-webkit-scrollbar-thumb {
        background-color: tomato !important;
        border-radius: 6px !important;
    }

    .swiper-scrollbar::webkit-scrollbar-track {
        background-color: gray !important;
    }

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .autoplay-progress {
        position: absolute;
        right: 16px;
        bottom: 16px;
        z-index: 10;
        width: 48px;
        height: 48px;
        display: hidden;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: var(--swiper-theme-color);
    }

    .autoplay-progress svg {
        --progress: 0;
        position: absolute;
        left: 0;
        top: 0px;
        z-index: 10;
        width: 100%;
        height: 100%;
        stroke-width: 4px;
        stroke: var(--swiper-theme-color);
        fill: none;
        stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
        stroke-dasharray: 125.6;
        transform: rotate(-90deg);
    }

    .responsive {
        position: relative;
    }

    .left {
        position: absolute;
        top: 50%;
        /* transform: translate(22% ,50%); */
        z-index: 2;
        transform: translateY(-50%);
        left: 10px;
        background-color: rgb(255, 99, 71, 0.3);
        height: 50px;
        width: 50px;
        border-radius: 100%;
        text-align: center;
        line-height: 50px !important;
    }

    .right {
        position: absolute;
        top: 50%;
        /* transform: translate(22% ,50%); */
        z-index: 2;
        transform: translateY(-50%);
        right: 10px;
        background-color: rgb(255, 99, 71, 0.3);
        height: 50px;
        width: 50px;
        border-radius: 100%;
        text-align: center;
        line-height: 50px !important;
    }

    .hover-menu:hover>ul {
        display: block;
    }
</style>
@section('frontend_content')
    <div class="container flex items-center justify-center h-64 mx-auto mt-6 banner lg:mt-4 mobile-container lg:h-96">
        <div class="swiper mySwiper">
            <div class="relative w-full h-64 swiper-wrapper lg:h-96 lg:w-5/6">
                @foreach ($banners as $banner)
                    <div class="w-full h-full cursor-pointer swiper-slide "
                        style="background-image: url('{{ asset('uploads/banner/' . $banner->banner_image) }}'); background-repeat: no-repeat; background-size: cover; background-position: center; border-radius: 0.75rem; display: flex; justify-content: flex-start;">
                        <div class="flex flex-col items-start justify-center w-3/4 gap-2 p-6 ml-5 text-left md:w-1/2 md:h-1/3 sm:h-1/4 lg:ml-10 bg-gray-300/50 lg:bg-transparent rounded-xl"
                            style="text-align: left;">
                            <h3 class="text-lg font-semibold text-red-500 lg:font-bold lg:text-xl">Trending Item</h3>
                            <h1 class="text-xl font-extrabold text-gray-800 lg:text-4xl">{{ $banner->small_text }}</h1>
                            <h4 class="text-gray-500 lg:text-xl lg:mb-4"> starting at $ 20.00</h4>
                            <button class="px-3 py-2 text-xs font-semibold text-white bg-red-400 rounded-xl">SHOP
                                NOW</button>
                        </div>


                    </div>
                @endforeach



            </div>
            <div class="swiper-scrollbar"></div>
        </div>
        {{-- <div class="">

    </div> --}}
    </div>
    <!-- banner -->
    <!-- category swiper -->

    <div class="container mt-5 mobile-container ">

        <div class="flex responsive">
            @foreach ($categories as $category)
                @php
                    $length = Str::length($category->category_name);
                @endphp
                <div class="flex items-center justify-between w-full cursor-pointer rounded-xl categories">
                    <div class="flex justify-between p-4 border shadow-lg cursor-pointer bo rounded-xl swiper-slide categories_slide_swiper w-[239.5px]"
                        style="align-items: flex-start;">
                        <div class="flex items-center justify-center w-12 h-12 py-2 border-2 rounded-lg bg-gray-400/20">
                            <img src="{{ asset('uploads/category/' . $category->category_photo) }}" alt="">
                        </div>
                        <div class="flex flex-col items-start ml-2">
                            <h3 class="mb-1 text-xs font-semibold text-gray-700 md:font-semibold md:text-sm">
                                {{ $length >= 10 ? Str::substr($category->category_name, 0, 10) . '...' : $category->category_name }}
                            </h3>
                            <form action="{{ route('search') }}" method="GET" style="margin-bottom: 1px">
                                <input type="hidden" value="{{ $category->id }}" name="category_id">
                                <button type="submit" class="text-xs font-semibold text-red-400 md:text-sm">Show
                                    all</button>
                            </form>
                        </div>
                        <span
                            class="ml-3 text-xs text-gray-400">({{ App\Models\Product::where('category_id', $category->id)->count() }})</span>
                    </div>



                </div>
            @endforeach


        </div>
        <div class="hidden autoplay-progress">
            <span> <svg viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="20"></circle>
                </svg></span>
        </div>
    </div>
    <!-- category swiper -->

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
                                        <img src="{{ asset('uploads/category/' . $category->category_photo) }}"
                                            alt="" class="w-4 h-4">
                                        <span>{{ Str::limit($category->category_name, 22, '..') }}</span>
                                    </div>
                                </summary>
                                @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                    <div class="flex items-center justify-between font-normal">
                                        <form action="{{ route('search') }}" method="GET" class="mb-0">
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

                    foreach ($products as $product) {
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
                                    <a href="{{ route('view.product', $product->slug) }}"><img
                                            src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                            class="w-full h-full" alt="{{ $product->name }}"></a>
                                </div>
                                <div class="text">
                                    <a href="{{ route('view.product', $product->slug) }}">
                                        <h4 class="text-gray-900">{{ $product->product_name }}</h4>
                                    </a>
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

        <div class="flex flex-col w-full lg:w-3/4 products">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col gap-4 new-arrival ">
                    <h1 class="pb-4 text-xl font-semibold border-b">New Arrivals</h1>
                    @foreach ($newProducts as $product)
                        <div
                            class="flex items-center w-full gap-4 p-4 bg-white border rounded-lg shadow-sm cursor-pointer h-28">
                            <div class="w-20 h-20 ">
                                <a href="{{ route('view.product', $product->slug) }}"><img
                                        src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                        class="w-full h-full rounded-md" alt=""></a>
                            </div>
                            <div class="w-full text">
                                @php
                                    $new_product_lenght = $product->product_name;
                                @endphp

                                <a href="{{ route('view.product', $product->slug) }}">
                                    <h4 class="text-lg font-semibold text-slate-700">

                                        {{ $new_product_lenght >= 15 ? Str::substr($new_product_lenght, '0', '15') . '..' : $product->product_name }}
                                    </h4>
                                </a>
                                <h4 class="text-sm font-semibold text-slate-500">{{ $product->rel_to_cat->category_name }}
                                </h4>
                                <div class="flex items-center justify-start gap-4">
                                    @if ($product != null)
                                        @if ($product->discount != 0)
                                            <strong
                                                class="text-red-400">${{ $product->rel_to_inventory->first()->after_discount_price }}</strong>
                                            <s>${{ $product->rel_to_inventory->first()->price }}</s>
                                        @else
                                            <strong
                                                class="text-red-400">${{ $product->rel_to_inventory->first()->price }}</strong>
                                        @endif
                                    @endif


                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <!-- trendind -->
                <div class="flex flex-col gap-4 trending">
                    <h1 class="pb-4 text-xl font-semibold border-b">Trending Products</h1>
                    @foreach ($trending_products as $trending_product)
                        <div
                            class="flex items-center w-full gap-4 p-4 bg-white border rounded-lg shadow-sm cursor-pointer h-28">
                            <div class="w-20 h-20 ">
                                <a href="{{ route('view.product', $trending_product->slug) }}"> <img
                                        src="{{ asset('uploads/products/preview/' . $trending_product->preview) }}"
                                        class="w-full h-full rounded-md" alt=""></a>
                            </div>
                            @php
                                $trend_length = $trending_product->product_name;
                            @endphp
                            <div class="w-full text">
                                <a href="{{ route('view.product', $trending_product->slug) }}">
                                    <h4 class="text-lg font-semibold text-slate-700 whitespace-nowrap">
                                        {{ $trend_length >= 15 ? Str::substr($trend_length, '0', '15') . '..' : $trending_product->product_name }}
                                    </h4>
                                </a>

                                <h4 class="text-sm font-semibold text-slate-500">
                                    {{ $trending_product->rel_to_cat->category_name }}</h4>
                                <div class="flex items-center justify-start gap-4">
                                    @if ($trending_product->discount != 0)
                                        <strong
                                            class="text-red-400">${{ $trending_product->rel_to_inventory->first()->after_discount_price }}</strong>
                                        <s>${{ $trending_product->rel_to_inventory->first()->price }}</s>
                                    @else
                                        <strong
                                            class="text-red-400">${{ $trending_product->rel_to_inventory->first()->price }}</strong>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <!-- top rated product -->
                <div class="flex flex-col gap-4 trending">
                    <h1 class="pb-4 text-xl font-semibold border-b">Top rated Products</h1>
                    @php

                        $productsWithRatings = [];

                        foreach ($products as $product) {
                            $reviews = App\Models\OrderProduct::where('product_id', $product->id)
                                ->whereNotNull('reviews')
                                ->get();
                            $review_count = $reviews->count();
                            $average_rating = $review_count > 0 ? $reviews->sum('stars') / $review_count : 0;

                            $productsWithRatings[] = [
                                'product' => $product,
                                'average_rating' => $average_rating,
                            ];
                        }

                        usort($productsWithRatings, function ($a, $b) {
                            return $b['average_rating'] <=> $a['average_rating'];
                        });
                        $productsWithRatings = collect($productsWithRatings);
                    @endphp
                    @foreach ($productsWithRatings->take(4) as $item)
                        <div
                            class="flex items-center w-full gap-4 p-4 bg-white border rounded-lg shadow-sm cursor-pointer h-28">
                            <div class="w-20 h-20 ">
                                @php
                                    $product = $item['product'];
                                    $average_rating = $item['average_rating'];
                                @endphp
                                <a href="single_product.html"> <img
                                        src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                        class="w-full h-full" alt=""></a>
                            </div>
                            <div class="text">
                                @php
                                    $rated_length = $product->product_name;
                                @endphp
                                <a href="{{ route('view.product', $product->slug) }}">
                                    <h4 class="text-lg font-semibold text-slate-700 whitespace-nowrap">
                                        {{ $rated_length >= 15 ? Str::substr($rated_length, '0', '15') . '..' : $product->product_name }}
                                    </h4>
                                </a>
                                <h4 class="text-sm font-semibold text-slate-500">{{ $product->rel_to_cat->category_name }}
                                </h4>
                                <div class="flex items-center justify-start gap-4">
                                    @if ($product->discount != 0)
                                        <strong
                                            class="text-red-400">${{ $product->rel_to_inventory->first()->after_discount_price }}</strong>
                                        <s>${{ $product->rel_to_inventory->first()->price }}</s>
                                    @else
                                        <strong
                                            class="text-red-400">${{ $product->rel_to_inventory->first()->price }}</strong>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-- deals of the day -->
            <div class="my-10">

                <h4 class="py-4 text-lg font-semibold border-b ">Deals of the day</h4>
                @foreach ($deals as $deal)
                    <div
                        class="flex flex-col w-full h-auto gap-2 p-4 mt-10 border rounded-lg ustify-between j lg:flex-row lg:items-center">
                        <img src="{{ asset('uploads/products/preview/' . $deal->rel_to_product->preview) }}"
                            class="rounded-lg lg:w-1/2" alt="">
                        <div class="flex flex-col items-start gap-3 p-4 lg:w-1/2 ">
                            @php
                                $avg = 0;
                                $reviews = App\Models\OrderProduct::where('product_id', $deal->product_id)
                                    ->whereNotNull('reviews')
                                    ->get();
                                $stars = App\Models\OrderProduct::where('product_id', $product->product_id)
                                    ->whereNotNull('reviews')
                                    ->sum('stars');
                                if ($reviews->count() != 0) {
                                    $avg = $stars / $reviews->count();
                                }
                            @endphp
                            <div class="stars" style="color: gold">
                                @for ($i = 1; $i <= $avg; $i++)
                                    <i class="fa-solid fa-star star"></i>
                                @endfor
                            </div>
                            @if ($reviews->count() == 1)
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }} review
                                </div>
                            @else
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }} reviews
                                </div>
                            @endif
                            <a href="{{ route('view.product', $deal->rel_to_product->slug) }}"
                                class="text-lg font-bold">{{ $deal->product_name }}</a>
                            <p>{{ $deal->rel_to_product->short_desp }}</p>
                            <div class="flex gap-4">
                                @if ($deal->rel_to_product->discount != 0)
                                    <strong
                                        class="text-xl font-bold text-red-400">${{ $deal->rel_to_product->rel_to_inventory->first()->after_discount_price }}</strong>
                                    <s
                                        class="text-xl text-gray-500">${{ $deal->rel_to_product->rel_to_inventory->first()->price }}</s>
                                @else
                                    <strong
                                        class="text-xl font-bold text-red-400">${{ $deal->rel_to_product->rel_to_inventory->first()->price }}</strong>
                                @endif

                            </div>
                            <a href="{{ route('view.product', $deal->rel_to_product->slug) }}"
                                class="px-4 py-2 font-semibold text-white bg-red-500 rounded-xl ">View Product</a>
                            <div class="flex gap-1">
                                <h3>HURRY UP! OFFER ENDS IN:</h3>
                                <span id="demo" data-end-date= "{{ $deal->end_date }}"></span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- new products -->
            <div class="newproduct">
                <h1 class="py-4 text-xl font-semibold border-b ">New Products</h1>
                <div class="grid grid-cols-2 gap-6 p-4 mt-8 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                        <div
                            class="relative flex flex-col w-full gap-2 p-4 bg-white border rounded-lg shadow-md h-92 product_pic group">
                            @if ($product->discount != 0)
                                <div
                                    class="absolute z-10 px-2 py-1 text-sm font-bold text-white bg-green-600 border rounded-md tax top-2 left-2">
                                    {{ $product->discount }}%</div>
                            @endif

                            <div
                                class="absolute z-10 flex-col hidden gap-2 text-xl font-semibold product_options top-[70px] right-2 group-hover:flex group-hover:animate-slideInFromRight">

                                <a href="{{ route('cart') }}">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-white border rounded-lg shadow-mdtext-gray-700 hover:text-white hover:bg-gray-700 ">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </div>
                                </a>
                                <a href="{{ route('view.product', $product->slug) }}">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 bg-white border rounded-lg shadow-mdtext-gray-700 hover:text-white hover:bg-gray-700 ">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </a>

                            </div>
                            <div class="w-full h-1/2">
                                <img src="{{ asset('uploads/products/preview/' . $product->preview) }}"
                                    class="object-cover w-full h-full transition-transform duration-300 rounded-md hover:scale-y-110 hover:scale-x-110 hover:opacity-100"
                                    alt="">
                            </div>
                            @php
                                $length_short_desp = $product->short_desp;
                            @endphp

                            <a href="{{ route('view.product', $product->slug) }}">
                                <h3 class="font-semibold text-red-500">{{ $product->product_name }}</h3>
                            </a>
                            <h5>{{ $length_short_desp >= 30 ? Str::substr($length_short_desp, 0, 30) . '...' : $product->short_desp }}
                            </h5>
                            @php
                                $avg = 0;
                                $reviews = App\Models\OrderProduct::where('product_id', $product->id)
                                    ->whereNotNull('reviews')
                                    ->get();
                                $stars = App\Models\OrderProduct::where('product_id', $product->id)
                                    ->whereNotNull('reviews')
                                    ->sum('stars');
                                if ($reviews->count() != 0) {
                                    $avg = $stars / $reviews->count();
                                }
                            @endphp
                            <div class="stars" style="color: gold">
                                @for ($i = 1; $i <= $avg; $i++)
                                    <i class="fa-solid fa-star star"></i>
                                @endfor
                            </div>
                            @if (!$reviews->count() != 0)
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }} reviews
                                </div>
                            @else
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }} review
                                </div>
                            @endif

                            <div class="flex items-center justify-start gap-4 text-sm font-semibold">

                                @if ($product->discount != 0)
                                    <strong>${{ $product->rel_to_inventory->first()->after_discount_price }}</strong>
                                    <s class="text-gray-500">${{ $product->rel_to_inventory->first()->price }}</s>
                                @else
                                    <strong>${{ $product->rel_to_inventory->first()->price }}</strong>
                                @endif


                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
        </div>

    </section>


    <!-- discount and services -->

    <div class="container flex flex-col flex-wrap w-full gap-8 mt-10 mb-20 mobile-container lg:flex-nowrap lg:flex-row">
        <div class="w-full testimonial lg:w-2/6">
            <h1 class="pb-4 mb-8 text-xl font-semibold border-b">Testimonial</h1>
            <div style="height: 23rem" class="flex flex-col items-center justify-center w-full p-4 border rounded-xl">
                <img class="object-cover w-20 h-20 rounded-full" src="{{ asset('frontend') }}/images/testimonial-1.jpg"
                    alt="testimonial" />
                <h2 class="text-lg font-bold text-gray-600">Sarah Couper</h2>
                <h5 class="text-md">CEO & Founder Invision</h5>
                <img class="w-6 h-6 my-4" src="{{ asset('frontend') }}/images/icons/quotes.svg" alt="quotes" />
                <p class="w-4/5 mx-auto text-sm text-center">
                    Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor dolor sit
                    amet.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-center w-full rounded-lg lg:w-3/6"
            style="background-image: url('{{ asset('frontend') }}/images/cta-banner.jpg');object-fit: cover; background-position: center; background-repeat: no-repeat;">
            <div class="flex flex-col items-center justify-center w-3/4 gap-4 p-8 rounded-lg bg-gray-100/70">
                <button class="p-2 text-white bg-gray-900 rounded-lg">
                    25% DISCOUNT
                </button>
                <h1 class="w-56 text-4xl font-bold text-center text-gray-800">
                    Summer Collection
                </h1>
                <h5 class="text-lg font-semibold text-gray-500">Starting @ $10</h5>
                <button class="text-lg font-semibold text-gray-500">
                    SHOP NOW
                </button>
            </div>
        </div>

        <div class="w-full OurServices lg:w-2/6">
            <h1 class="pb-4 mb-8 text-xl font-semibold border-b sm:text-center lg:text-left">Our Services</h1>
            <div style="height: 23rem"
                class="flex flex-wrap items-center justify-between w-full p-4 border rounded-xl lg:flex-col lg:justify-center lg:px-8 lg:gap-8">
                <div class="flex items-center justify-center w-1/2 gap-2 lg:w-full lg:justify-between">
                    <i class="text-xl text-red-500 fa-solid fa-anchor"></i>
                    <div>
                        <h3 class="font-semibold text-gray-700">Worldwide Delivery</h3>
                        <p class="text-xs text-gray-600">For Order Over $100</p>
                    </div>
                </div>

                <div class="flex items-center justify-center w-1/2 gap-2 lg:w-full lg:justify-between">
                    <i class="text-xl text-red-500 fa-solid fa-rocket"></i>
                    <div>
                        <h3 class="font-semibold text-gray-700">Worldwide Delivery</h3>
                        <p class="text-xs text-gray-600">For Order Over $100</p>
                    </div>
                </div>

                <div class="flex items-center justify-center w-1/2 gap-2 lg:w-full lg:justify-between">
                    <i class="text-xl text-red-500 fa-solid fa-phone"></i>
                    <div>
                        <h3 class="font-semibold text-gray-700">Worldwide Delivery</h3>
                        <p class="text-xs text-gray-600">For Order Over $100</p>
                    </div>
                </div>

                <div class="flex items-center justify-center w-1/2 gap-2 lg:w-full lg:justify-between">
                    <i class="text-xl text-red-500 fa-solid fa-rotate-left"></i>
                    <div>
                        <h3 class="font-semibold text-gray-700">Worldwide Delivery</h3>
                        <p class="text-xs text-gray-600">For Order Over $100</p>
                    </div>
                </div>

                <div class="flex items-center justify-center w-1/2 gap-2 lg:w-full lg:justify-between">
                    <i class="text-xl text-red-500 fa-solid fa-ticket"></i>
                    <div>
                        <h3 class="font-semibold text-gray-700">Worldwide Delivery</h3>
                        <p class="text-xs text-gray-600">For Order Over $100</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--  -->
    <!-- blog part -->
    <div class="container py-10 mobile-container" id="blog">
        <div
            class="flex flex-wrap justify-center w-full gap-5 lg:gap-10 md:justify-center md:gap-10 xl:grid-cols-4 md:grid-cols-2 md:flex-wrap lg:grid-cols-2 lg:justify-normal xl:justify-center">
            <div class="flex flex-col rounded-lg w-[250px] h-auto shadow-lg ">
                <img src="{{ asset('frontend') }}/images/blog-01.jpg" class="w-full h-full rounded-lg" alt="">

                <div class="flex flex-col items-start justify-start gap-2 mt-4 p-3.5">
                    <h3 class="text-red-400">Fashion</h3>
                    <a href="#" class="text-sm font-semibold cursor-pointer lg:text-lg hover:text-red-500">Clothes
                        Retail KPIs
                        2021 Guide for Clothes Executives.</a>
                    <h4 class="text-xs text-gray-500 lg:text-sm">By Mr Admin / Apr 06, 2022</h4>
                </div>
            </div>
            <div class="flex flex-col rounded-lg w-[250px] h-auto shadow-lg ">
                <img src="{{ asset('frontend') }}/images/blog-02.jpg" class="w-full h-full rounded-lg" alt="">

                <div class="flex flex-col items-start justify-start gap-2 mt-4 p-3.5">
                    <h3 class="text-red-400">Fashion</h3>
                    <a href="#" class="text-sm font-semibold cursor-pointer lg:text-lg hover:text-red-500">Clothes
                        Retail KPIs
                        2021 Guide for Clothes Executives.</a>
                    <h4 class="text-xs text-gray-500 lg:text-sm">By Mr Admin / Apr 06, 2022</h4>
                </div>
            </div>
            <div class="flex flex-col rounded-lg w-[250px] h-auto shadow-lg ">
                <img src="{{ asset('frontend') }}/images/blog-03.jpg" class="w-full h-full rounded-lg" alt="">

                <div class="flex flex-col items-start justify-start gap-2 mt-4 p-3.5">
                    <h3 class="text-red-400">Fashion</h3>
                    <a href="#" class="text-sm font-semibold cursor-pointer lg:text-lg hover:text-red-500">Clothes
                        Retail KPIs
                        2021 Guide for Clothes Executives.</a>
                    <h4 class="text-xs text-gray-500 lg:text-sm">By Mr Admin / Apr 06, 2022</h4>
                </div>
            </div>
            <div class="flex flex-col rounded-lg w-[250px] h-auto shadow-lg ">
                <img src="{{ asset('frontend') }}/images/blog-04.jpg" class="w-full h-full rounded-lg" alt="">

                <div class="flex flex-col items-start justify-start gap-2 mt-4 p-3.5">
                    <h3 class="text-red-400">Fashion</h3>
                    <a href="#" class="text-sm font-semibold cursor-pointer lg:text-lg hover:text-red-500">Clothes
                        Retail KPIs
                        2021 Guide for Clothes Executives.</a>
                    <h4 class="text-xs text-gray-500 lg:text-sm">By Mr Admin / Apr 06, 2022</h4>
                </div>
            </div>



        </div>

    </div>
@endsection
{{-- @section('footer_content')
<script>
    function submitForm(categoryId, subId) {
        const form = document.getElementById('categoryForm');
        // Clear previous sub_id
        const subIdInput = document.querySelector('input[name="sub_id"]');
        if (subIdInput) {
            subIdInput.value = subId;
        } else {
            const newSubIdInput = document.createElement('input');
            newSubIdInput.type = 'hidden';
            newSubIdInput.name = 'sub_id';
            newSubIdInput.value = subId;
            form.appendChild(newSubIdInput);
        }
        form.querySelector('input[name="category_id"]').value = categoryId;
        form.submit();
    }
    </script>

@endsection --}}
