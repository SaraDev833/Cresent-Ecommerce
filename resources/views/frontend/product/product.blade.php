<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- font awesome -->
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- swiper -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/output.css" />
</head>

<body>
    <style>
        summary {
            list-style-type: none;
            cursor: pointer;
            position: relative;

        }

        summary::after {
            content: '+';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
        }

        details[open] summary::after {
            content: "-";
        }

        #sidebarCategories::-webkit-scrollbar {
            width: 7px;
            height: 5px !important;
        }

        #sidebarCategories::-webkit-scrollbar-thumb {
            background-color: tomato;
            border-radius: 6px;

        }

        #sidebarCategories::-webkit-scrollbar-track {
            background-color: rgb(125, 119, 119);
        }

        #aside::-webkit-scrollbar {
            width: 4px;
            height: 5px;
        }

        #aside::-webkit-scrollbar-thumb {
            background-color: rgb(137, 128, 128);
            border-radius: 6px;
        }

        #aside::webkit-scrollbar-track {
            background-color: rgb(161, 113, 113);
        }

        .hover-menu:hover>ul {
            display: block;
        }

        .swiper {
            width: 100%;
            height: 100%;
            margin: 0px !important;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }



        .swiper {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .swiper-container-2 {
            height: 70%;
            width: 100%;
        }

        .swiper-container {

            box-sizing: border-box;
            padding: 50px 0;
        }



        .swiper-container .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .star.selected {
            color: gold;
        }
    </style>
    <!-- header... -->
    <header class="w-full header ">
        <div class="container flex flex-col items-center justify-between w-screen border-b mobile-container top-header">
            <!-- top-header -1st -part -->
            <div class="flex items-center justify-between w-full p-4 border-b md:px-20">
                <div class="items-center hidden gap-2 icons lg:flex">
                    <a href="#"
                        class="flex items-center p-1 text-gray-700 transition-all rounded-md items- bg-gray-300/50 hover:scale-110 hover:text-white hover:bg-red-400"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a href="#"
                        class="flex items-center p-1 text-gray-700 transition-all rounded-md bg-gray-300/50 hover:text-white hover:bg-red-400 hover:scale-110"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="#"
                        class="flex items-center p-1 text-gray-700 transition-all rounded-md bg-gray-300/50 hover:text-white hover:bg-red-400 hover:scale-110"><i
                            class="fa-brands fa-linkedin-in"></i></i></a>
                </div>
                <h3 class="text-xs font-semibold text-gray-400">
                    Free shipping this week over - $55
                </h3>
                {{-- <div class="hidden select md:flex">
                    <select class="p-1 px-2 text-sm font-semibold mr2" name="" id="currency">
                        <option value="usd">USD $</option>
                        <option value="eur">EUR £</option>
                    </select>
                    <select name="" id="" class="p-1 px-2 mr-2 text-sm font-semibold">
                        <option value="Persian">Persian</option>
                        <option value="English">English</option>
                    </select>
                </div> --}}
            </div>
            <!-- top-header -1st -part end -->
            <!-- top header 2nd part start--- -->
            <div class="flex flex-col items-center justify-between w-full gap-3 p-6 sm:flex-row md:px-24">
                <a href="{{ route('home') }}">
                    <h1 class="text-3xl font-semibold text-gray-600">Cresent</h1>
                </a>
                <form class="relative w-full mb-0 sm:w-3/5" style="margin-bottom: 0" action="{{ route('search') }}"
                    method="GET" id="searchForm">
                    <input type="text" id="search" name="search"
                        class="w-full h-full p-2 outline-none focus:ring-red-500 focus:transition-transform rounded-xl ring-1 placeholder:text-slate-400 ring-slate-700"
                        placeholder="input your product name...">
                    <label for="search" class="absolute top-2 translate-x-[-30px] cursor-pointer"
                        onclick="document.getElementById('searchForm').submit();">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </label>
                    <button type="submit" class="hidden">Search</button>
                </form>

                <div class="hidden gap-8 mr-2 text-xl text-gray-600 icons lg:flex">
                    @auth('customer')
                        <div class="relative">
                            <a href="{{ route('customer.profile') }}" class="transition-transform hover:text-red-400"> <i
                                    class="fa-regular fa-user"></i></a>
                        </div>
                        <div class="relative">
                            <a href="{{ route('customer.logout') }}"
                                class="px-2 py-1 text-sm font-medium text-white transition-transform bg-red-400 rounded-lg">
                                Logout
                            </a>
                        </div>
                    @else
                        <div class="relative">
                            <a href="{{ route('customer.login') }}"
                                class="px-2 py-1 text-sm font-medium text-white transition-transform bg-red-400 rounded-lg">
                                Login
                            </a>
                        </div>
                    @endauth

                    <div class="relative ">
                        <span
                            class="absolute w-4 h-4 text-xs font-semibold text-center text-white bg-red-400 rounded-full -top-1 -right-2">
                            {{ App\Models\Wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}
                        </span>
                        <a href="{{ route('wishlist') }}" class="transition-transform hover:text-red-400"> <i
                                class="fa-regular fa-heart"></i></a>
                    </div>
                    <div class="relative">
                        <span
                            class="absolute w-4 h-4 text-xs font-semibold text-center text-white bg-red-400 rounded-full -top-1 -right-2">{{ App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->count() }}</span>
                        <a href="{{ route('cart') }}"
                            class="text-gray-600 transition-colors duration-300 hover:text-red-400 active:text-red-600">
                            <i class="fa-solid fa-cart-shopping"></i></a>
                    </div>

                </div>
            </div>
            <!-- top header 2nd part end--- -->
        </div>
        <!-- desktop navbar -->
        <div class="dektopNavbar">
            <nav class="container justify-center hidden my-4 lg:flex mobile-container">
                <ul class="flex justify-center gap-12 font-bold text-gray-600 desktopNavbarul font-sm">
                    <li class="relative nav_items group ">
                        <a href="{{ route('home') }}"
                            class="font-semibold transition duration-300 hover:text-red-400 text-slate-600">Home</a>
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 transition-all ease-in-out group-hover:w-full"></span>
                    </li>

                    @foreach (App\Models\Category::all() as $category)
                        <li class="relative group nav_items">
                            <a href="#"
                                class="font-semibold transition duration-300 hover:text-red-400 text-slate-600 whitespace-nowrap">{{ $category->category_name }}</a>
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 transition-all group-hover:w-full"></span>
                            <ul
                                class="absolute z-10 flex-col items-start justify-start hidden gap-2 p-4 font-normal transition-all bg-white shadow-lg rounded-xl top-full group-hover:flex w-52">
                                @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                    <li class="relative hover-menu">
                                        <form action="{{ route('search') }}" method="GET" style="margin-bottom: 1px">
                                            <input type="hidden" value="{{ $subcategory->id }}"
                                                style="margin-bottom: 1px" name="sub_id">
                                    <li> <button type="submit"
                                            class="block transition duration-300 hover:text-red-400">{{ $subcategory->subcategory_name }}</button>

                                        <!-- Secondary Dropdown Menu -->
                                        </form>
                                        <ul
                                            class="absolute top-0 z-20 hidden p-4 space-y-2 transition duration-300 bg-white shadow-lg left-full w-52 rounded-xl hover-menu-content">
                                            @forelse (App\Models\SubcategoryItem::where('subcategory_id', $subcategory->id)->get() as $item)
                                                <form action="{{ route('search') }}" method="GET">
                                                    @php
                                                        $item_lenght = $item->sub_item_name;
                                                    @endphp
                                                    <input type="hidden" value="{{ $item->id }}"
                                                        style="margin-bottom: 1px" name="item_id">

                                                    <li> <button type="submit"
                                                            class="block px-2 transition duration-300 hover:text-red-400 whitespace-nowrap">{{ $item_lenght >= 20 ? Str::substr($item_lenght, 0, 20) . '...' : $item->item_name }}</button>

                                                    </li>
                                                </form>
                                            @empty
                                                no item
                                            @endforelse
                                        </ul>


                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach





                </ul>
            </nav>
        </div>
        <!-- desktop navbar -->
        <!-- mobile navbar ---->
        <div class="mobileNavbar">
            <div class="fixed bottom-0 z-10 flex items-center justify-around p-4 text-lg -translate-x-1/2 bg-white border bg-w-hite left-1/2 lg:hidden rounded-t-xl w-96"
                style="box-shadow: 0 0 0 0.3rem lightgray">
                <button id="openNavbarButton" type="button" class="text-xl transition-all hover:text-red-400">
                    <i class="fa-solid fa-bars"></i>
                </button>
                {{-- @php
                   $cart= App\Models\Cart::where('customer_id' , Auth::guard('customer')->id())->first();
                @endphp --}}
                <a href="{{ route('cart') }}" class="relative text-xl transition-all hover:text-red-400">
                    <span
                        class="absolute w-4 h-4 text-xs font-semibold text-center text-white bg-red-400 rounded-full -right-2 -top-1">{{ App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->count() }}</span>
                    <i class="fa-solid fa-cart-shopping "></i>
                </a>
                <a href="{{ route('home') }}" class="relative text-xl transition-all hover:text-red-400 ">
                    <i class="fa-solid fa-house"></i>
                </a>
                <a href="{{ route('wishlist') }}" class="relative text-xl transition-all hover:text-red-400">
                    <span
                        class="absolute w-4 h-4 text-xs font-semibold text-center text-white bg-red-400 rounded-full -top-1 -right-2">{{ App\Models\Wishlist::where('customer_id', Auth::guard('customer')->id())->count() }}</span>
                    <i class="fa-regular fa-heart"></i>
                </a>
                <button id="categoryButton" type="button" class="text-xl transition-all hover:text-red-400 ">
                    <i class="fa-solid fa-list"></i>
                </button>
            </div>
            <!-- overlay navbar -->
            <div id="overlayNavbar"
                class="fixed top-0 left-0 z-10 hidden w-screen h-screen transition-opacity duration-300 ease-in-out bg-gray-500/30">
            </div>
        </div>
        <!-- side navbar -->
        <div id="sidebarNavbar"
            class="fixed top-0 left-0 z-20 flex-col justify-start hidden h-screen p-4 overflow-auto text-lg font-semibold bg-white shadow-lg w-72 animate-fadeX">
            <div class="flex justify-between py-4 border-b-2 ">
                <h3 class="font-semibold text-slate-700">Menu</h3>
                <button class="transition-all closeButton hover:text-red-400">
                    <i class="fa-regular fa-circle-xmark"></i>
                </button>
            </div>
            <div class="p-3 font-semibold text-gray-600 border-b mobile_nav_items">
                <a href="#">Home</a>
            </div>
            @foreach (App\Models\Category::all() as $category)
                <div class="p-3 text-lg font-semibold text-gray-600 border-b">
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


            <div class="p-3 text-gray-600 border-b mobile_nav_items">
                <a href="#">Blog</a>
            </div>
            <div class="p-3 text-gray-600 border-b mobile_nav_items">
                <a href="#">Hot Offers</a>
            </div>
            <div class="flex items-center justify-between p-3">
                @auth('customer')
                    <div class="relative">
                        <a href="{{ route('customer.profile') }}"
                            class="text-gray-600 transition-transform border-b-2 border-b-red-500"> My Profile
                        </a>
                    </div>
                    <div class="relative">
                        <a href="{{ route('customer.logout') }}"
                            class="px-2 py-1 text-sm font-medium text-white transition-transform bg-red-400 rounded-lg">
                            Logout
                        </a>
                    </div>
                @else
                    <div class="relative">
                        <a href="{{ route('customer.login') }}"
                            class="px-2 py-1 text-sm font-medium text-white transition-transform bg-red-400 rounded-lg">
                            Login
                        </a>
                    </div>
                @endauth
            </div>
            {{-- <div class="p-3 text-gray-600 mobile_nav_items">


                <details class="flex flex-col pb-3 ">
                    <a href="#" class="w-full pb-2 font-normal text-gray-500 border">English</a>
                    <a href="#" class="w-full pb-2 font-normal border text-gay-500">Persian</a>
                    <summary>Language</summary>
                </details>


            </div> --}}
        </div>
        <!-- mobile navbar -->
        <!-- categories navbar -->
        <div id="sidebarCategories"
            class="fixed top-0 left-0 z-20 flex-col justify-start hidden h-screen gap-4 p-6 overflow-y-auto bg-white shadow-lg w-80 animate-fadeX ">
            <div class="flex flex-col w-full h-auto gap-4 categories">
                <div class="flex items-center justify-between w-full pb-2 border-b-2">

                    <h3 class="font-semibold text-slate-700">CATEGORIES</h3>
                    <button class="transition-all closeButton hover:text-red-400">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </button>
                </div>
                @foreach (App\Models\Category::all() as $category)
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

                foreach (App\Models\Product::all() as $product) {
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

            <div class="flex flex-col w-full h-auto gap-5 mt-7 best_sellers">
                <h2 class="my-4 text-lg font-semibold">BEST SELLERS</h2>
                @if ($productsWithRatings->every(fn($item) => $item['average_rating'] == 0))
                    <span class="text-sm font-semibold text-slate-600">No review on any product Yet</span>
                @else
                    @foreach ($productsWithRatings->take(5) as $item)
                        @php
                            $product = $item['product'];
                            $average_rating = $item['average_rating'];
                        @endphp
                        <div class="flex items-center gap-4">
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
    </header>
    {{-- header --}}
    <!-- single product  -->
    <div class="container p-10 border single_product mobile-container">

        <div
            class="flex flex-col justify-between w-full gap-8 sm:flex-col sm:justify-center sm:items-center md:flex-row md:items-start">
            <div class="w-full md:w-2/5">
                <div class="relative px-5 h-fit">

                    <div class="product " style="width: 100%; ">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="shadow-lg swiper swiper-container-2">

                            <div class="swiper-wrapper">
                                @foreach ($galleries as $gallery)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('uploads/products/galleries/' . $gallery->gallery_name) }}"
                                            height="100%" width="100%" />
                                    </div>
                                @endforeach



                            </div>

                        </div>
                        <div thumbsSlider="" class="swiper swiper-container ">
                            <div class="swiper-wrapper">
                                @foreach ($galleries as $gallery)
                                    <div class="shadow-md swiper-slide"
                                        style="height: 140px !important; width: 100px !important;">
                                        <img
                                            src="{{ asset('uploads/products/galleries/' . $gallery->gallery_name) }}" />
                                    </div>
                                @endforeach



                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <form action="{{ route('add.cart', $product_detail->first()->id) }}" method="POST">
                @csrf
                @if (session('updated'))
                    <div class="p-4 text-white rounded-md" style="background-color: rgb(155, 169, 155)">
                        {{ session('updated') }}</div>
                @endif
                <input type="hidden" id="selected_color" name="color_id">
                <input type="hidden" id="selected_size" name="size_id">
                <input type="hidden" name="quantity" id="selected_quantity" />

                <input type="hidden" name="price" id="selected_price" />
                <div class="w-full md:w-2/3">
                    @if (session('stock'))
                        <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">
                            {{ session('stock') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="w-full px-3 py-2 my-3 text-sm font-semibold bg-red-300 rounded-lg">
                            {{ session('error') }}</div>
                    @endif
                    <div class="flex flex-col gap-6 ">

                        <h1 class="text-2xl font-bold text-left text-slate-800">
                            {{ $product_detail->first()->product_name }}</h1>
                        <div class="flex gap-4">

                            @php
                                $avg = 0;
                                $reviews = App\Models\OrderProduct::where('product_id', $product_detail->first()->id)
                                    ->whereNotNull('reviews')
                                    ->get();
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
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }}
                                    review</div>
                            @else
                                <div class="text-sm font-semibold review text-slate-700">{{ $reviews->count() }}
                                    reviews</div>
                            @endif

                        </div>
                        <div class="flex flex-wrap gap-4 ">
                            @php
                                $product = App\Models\Product::find($product_detail->first()->id);
                            @endphp
                            @if ($product_detail->first()->discount != 0)
                                <strong
                                    class="text-lg text-red-400 price">${{ $product->rel_to_inventory->first()->after_discount_price }}</strong>
                                <s
                                    class="text-base text-slate-400 original-price">${{ $product->rel_to_inventory->first()->price }}</s>
                            @else
                                <strong
                                    class="text-lg text-red-400 price original-price">${{ $product->rel_to_inventory->first()->price }}</strong>
                            @endif

                        </div>
                        <p class="text-lg font-semibold text-slate-600">{{ $product->short_desp }} </p>
                        <div class="flex items-center gap-4">
                            <span class="text-lg font-semibold text-gray-900">Color:</span>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($inventories as $inventory)
                                    @if ($inventory->rel_to_color->color_name == 'N/A')
                                        <button
                                            class="w-8 h-8 text-sm transition-all border-2 rounded-sm hover:border-gray-400 shrink-0 color_id"
                                            type="button" name="color_id"
                                            value="{{ $inventory->rel_to_color->id }}">N/A</button>
                                    @else
                                        <button
                                            class="w-8 h-8 transition-all border-2 rounded-full hover:border-gray-800 shrink-0 color_id"
                                            type="button" name="color_id"
                                            style="background-color: {{ $inventory->rel_to_color->color_code }}"
                                            value="{{ $inventory->rel_to_color->id }}"></button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-lg font-semibold text-gray-900">Size:</span>

                            <div class="flex flex-wrap gap-3 size">
                                <button type="button"
                                    class="w-8 h-8 text-center transition-all border-2 rounded-sm hover:border-gray-400 bg-gray-50 shrink-0"
                                    name="size_id">s</button>
                                <button type="button"
                                    class="w-8 h-8 text-center transition-all border-2 rounded-sm hover:border-gray-400 bg-gray-50 shrink-0">M</button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <button id="decrease"
                                class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring"
                                type="button">
                                -
                            </button>
                            <input type="number" id="quantity"
                                class="w-[50px] px-1 py-1 text-center border border-gray-300 rounded" value="1"
                                min="1" name="quantity">
                            <button id="increase"
                                class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring"
                                type="button">
                                +
                            </button>

                            <button class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg"
                                id="cart" type="submit">Add to cart</button>

                            <a href="#" class="flex items-center justify-center bg-white rounded-md b w-9 h-9"
                                id="heart-btn"><i class="text-2xl text-red-500 fa-regular fa-heart"
                                    id="heart-icon"></i></a>


                        </div>

                        <div class="flex flex-wrap gap-4">
                            <span class="text-lg font-semibold text-gray-900">
                                Quantity: <span class="font-normal text-red-500 quantity">
                                    @if ($product->rel_to_inventory->first()->quantity != 0)
                                        In stock
                                    @else
                                        Out of stock
                                    @endif
                                </span>
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            @php
                                $explode = explode(',', $product->tag_id);
                            @endphp
                            <span class="text-lg font-semibold text-gray-900">tags :</span>
                            @foreach ($explode as $tag)
                                <span
                                    class="px-2 py-1 text-sm font-semibold text-white bg-red-500 rounded-lg">{{ App\Models\Tag::where('id', $tag)->first()->tag_name }}</span>
                            @endforeach


                        </div>
                        <div class="flex flex-wrap gap-4">
                            <span class="text-lg font-semibold text-gray-900">Brand :</span>
                            <span
                                class="px-2 py-1 text-sm font-semibold text-white bg-red-500 rounded-lg">{{ $product->rel_to_brand->brand_name }}</span>

                        </div>


                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- product information -->

    <div class="container flex flex-col gap-4 p-10 border shadow-lg mt-7 mobile-container">
        <h3 class="text-xl font-bold text-slate-800">Description</h3>
        {!! $product_detail->first()->long_desp !!}
    </div>
    <!-- review -->

    <div class="container flex flex-col justify-between border shadow-lg mt-7 p-7 gap-7 mobile-container md:flex-row">

        <div class="flex flex-col w-full gap-4 md:w-2/4">
            <h2 class="text-xl font-bold text-slate-800">
                Reviews({{ App\Models\OrderProduct::where('product_id', $product_detail->first()->id)->whereNotNull('reviews')->get()->count() }})
            </h2>
            <div class="flex flex-col gap-[25px]">
                @forelse (App\Models\OrderProduct::where('product_id' , $product_detail->first()->id)->whereNotNull('reviews')->get() as $review)

                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-1">

                            <img src="{{ Avatar::create($review->rel_to_customer->name)->toBase64() }}"
                                class="object-contain border rounded-full h-11 w-11" alt="">
                            <h3 class="text-lg font-semibold text-slate-600">{{ $review->rel_to_customer->name }}</h3>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class=" stars" style="color:gold">
                                @for ($i = 1; $i <= $review->stars; $i++)
                                    <i class="fa-solid fa-star star"></i>
                                @endfor


                            </div>
                            <span
                                class="text-sm font-semibold text-slate-500">{{ $review->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-sm font-semibold text-slate-800">{{ $review->reviews }}</p>
                    </div>
                @empty
                    <span
                        class="flex items-center justify-center w-full text-lg font-semibold text-center text-slate-700">No
                        reviews yet!</span>

                @endforelse
            </div>

        </div>
        <div class="flex flex-col items-start w-full gap-2 md:w-2/4">

            {{-- <a href="#"
                class="px-4 py-2 text-red-400 transition-all border border-red-400 rounded-md hover:bg-red-500 hover:text-white">See
                all review</a> --}}
            @auth('customer')
                @if (App\Models\OrderProduct::where('product_id', $product_detail->first()->id)->where('customer_id', Auth::guard('customer')->id())->exists())
                    {{-- @if (App\Models\OrderProduct::where('product_id', $product->id)->where('customer_id', Auth::guard('customer')->id())->first()->reviews == null) --}}
                    <form action="{{ route('add.review', $product_detail->first()->id) }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <h2 class="text-xl font-semibold ">Add a review</h2>
                            @error('star')
                                <div class="px-3 py-2 my-2 bg-red-300 rounded-md text-slate-700">{{ $message }}</div>
                            @enderror
                            <div class="flex items-center gap-3 my-2 stars" id="star-rating">

                                <label class="text-gray-300">
                                    <input type="radio" class="hidden" name="star" value="1">
                                    <i class="fa-solid fa-star star"></i>
                                </label>
                                <label class="text-gray-300">
                                    <input type="radio" class="hidden" name="star" value="2">
                                    <i class="fa-solid fa-star star"></i>
                                </label>
                                <label class="text-gray-300">
                                    <input type="radio" class="hidden" name="star" value="3">
                                    <i class="fa-solid fa-star star"></i>
                                </label>
                                <label class="text-gray-300">
                                    <input type="radio" class="hidden" name="star" value="4">
                                    <i class="fa-solid fa-star star"></i>
                                </label>
                                <label class="text-gray-300">
                                    <input type="radio" class="hidden" name="star" value="5">
                                    <i class="fa-solid fa-star star"></i>
                                </label>


                            </div>
                            @error('review')
                                <div class="px-3 py-2 my-2 bg-red-300 rounded-md text-slate-700">{{ $message }}</div>
                            @enderror
                            <input type="text"
                                class="w-[350px] py-3 border-[1px] border-gray-700 ring-0 focuse:rng-1 focus:ring-red-400 outline-none rounded-md"
                                name="review">
                            <div class="my-3">
                                <button type="submit" class="px-3 py-2 text-sm text-white bg-red-500 rounded-md">Add
                                    Review</button>
                            </div>
                        </div>
                    </form>
                    {{-- @else
                        <span class="block py-2 my-10 text-lg font-semibold text-left text-slate-700">You have already
                            reviewed this product!!</span>
                    @endif --}}
                @endif
            @endauth

        </div>
    </div>
    </div>

    <!--  footer -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        // Initialize Swiper
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 10,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
        });

        var swiper2 = new Swiper(".swiper-container-2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });

        $(document).ready(function() {
            const product_id = '{{ $product->id }}';
            const customer_id = '{{ Auth::guard('customer')->id() }}';
            const wishlist_id = '{{ $wishlist->isNotEmpty() ? $wishlist->first()->id : '' }}';
            const isLoggedIn = {{ Auth::guard('customer')->check() ? 'true' : 'false' }};

            // CSRF Token Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Color Selection
            $('.color_id').on('click', function() {
                var color_id = $(this).val();
                $('#selected_color').val(color_id);

                $.ajax({
                    type: 'POST',
                    url: '/getsize',
                    data: {
                        'color_id': color_id,
                        'product_id': product_id
                    },
                    success: function(data) {
                        $('.size').html(data).off('click', 'button').on('click', 'button',
                            function() {
                                var size_id = $(this).val();
                                $('#selected_size').val(size_id);
                                getPrice(color_id, product_id, size_id);
                            });
                    }
                });
            });

            function getPrice(color_id, product_id, size_id) {
                $.ajax({
                    type: 'POST',
                    url: '/getprice',
                    data: {
                        'color_id': color_id,
                        'product_id': product_id,
                        'size_id': size_id
                    },
                    success: function(data) {
                        if (data.price) {
                            $('.price').html(data.price);
                            $('#selected_price').val(data.price);
                        }
                        if (data.original_price) {
                            $('.original-price').html(data.original_price);
                        }
                        getQuantity(color_id, size_id, product_id);
                    }
                });
            }

            function getQuantity(color_id, size_id, product_id) {
                $.ajax({
                    type: 'POST',
                    url: '/getquantity',
                    data: {
                        'color_id': color_id,
                        'size_id': size_id,
                        'product_id': product_id
                    },
                    success: function(data) {
                        $('.quantity').html(data);
                        $('#selected_quantity').val(data);
                    }
                });
            }

            // Quantity Increase/Decrease
            document.getElementById('increase').addEventListener('click', function() {
                const quantityInput = document.getElementById('quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });

            document.getElementById('decrease').addEventListener('click', function() {
                const quantityInput = document.getElementById('quantity');
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            // Wishlist Button
            document.getElementById('heart-btn').addEventListener('click', function(event) {
                event.preventDefault();
                const heartIcon = document.getElementById('heart-icon');

                if (!isLoggedIn) {
                    alert('You need to log in first to add items to your wishlist.');
                    return;
                }

                if (heartIcon.classList.contains('fa-regular')) {
                    heartIcon.classList.remove('fa-regular');
                    heartIcon.classList.add('fa-solid');
                    localStorage.setItem(`wishlist_item_${product_id}`, 'true');

                    $.ajax({
                        type: 'POST',
                        url: '/add/wishlist',
                        data: {
                            'product_id': product_id,
                            'customer_id': customer_id
                        },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                } else {
                    heartIcon.classList.remove('fa-solid');
                    heartIcon.classList.add('fa-regular');
                    localStorage.removeItem(`wishlist_item_${product_id}`);
                }
            });

            // Restore Wishlist Icon State
            window.onload = function() {
                const heartIcon = document.getElementById('heart-icon');
                if (localStorage.getItem(`wishlist_item_${product_id}`)) {
                    heartIcon.classList.remove('fa-regular');
                    heartIcon.classList.add('fa-solid');
                } else {
                    heartIcon.classList.remove('fa-solid');
                    heartIcon.classList.add('fa-regular');
                }
            };

            // Star Rating
            const stars = document.querySelectorAll('#star-rating label');
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars.forEach((s, i) => {
                        s.querySelector('.star').classList.toggle('selected', i <= index);
                    });
                });
            });

            // Add to Cart
            const addToCartBtn = document.getElementById('cart');
            const colorButtons = document.querySelectorAll('button.color_id');
            let selectedColor = null;

            colorButtons.forEach(button => {
                button.addEventListener('click', function() {
                    colorButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedColor = button.value;
                    document.getElementById('selected_color').value = selectedColor;
                });
            });

            addToCartBtn.addEventListener('click', function(event) {
                if (!selectedColor) {
                    event.preventDefault();
                    alert('Please select a color and then size before adding to cart.');
                }
            });
        });
    </script>


</body>

</html>
