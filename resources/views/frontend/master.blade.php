<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>eCommerece</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- font awesome -->
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <!-- slick -->
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- swiper -->
    {{-- <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('frontend') }}/output.css" />
    <style>
        html {
            scroll-behavior: smooth;
            /* This enables smooth scrolling */
        }
    </style>
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
    <!-- header... -->
    <!-- banner -->
    @yield('frontend_content')
    <!-- footer -->
    <div class="w-screen bg-[#212121]">
        <div class="container py-10 mobile-container footer">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3 lg:grid-cols-5 my-[60px]">
                <div>
                    <h3 class="font-bold text-white txt-md">POPULAR CATEGORIES</h3>
                    <hr class="w-4 mt-2 mb-4 bg-red-500">
                    <ul class="flex flex-col justify-start gap-2 text-gray-500">
                        <li>
                            <a href="#">FASHION</a>
                        </li>
                        <li>
                            <a href="#">Electronic</a>
                        </li>
                        <li>
                            <a href="#">Cosmetic</a>
                        </li>
                        <li>
                            <a href="#">Health</a>
                        </li>
                        <li>
                            <a href="#">Watches</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white txt-md">PRODUCTS</h3>
                    <hr class="w-4 mt-2 mb-4 bg-red-500">
                    <ul class="flex flex-col justify-start gap-2 text-gray-500">
                        <li>
                            <a href="#">Prices Drop</a>
                        </li>
                        <li>
                            <a href="#">New Products</a>
                        </li>
                        <li>
                            <a href="#">Best Sales</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                        <li>
                            <a href="#">Sitemap</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white txt-md">OUR COMPANY</h3>
                    <hr class="w-4 mt-2 mb-4 bg-red-500">
                    <ul class="flex flex-col justify-start gap-2 text-gray-500">
                        <li>
                            <a href="#">Delivery</a>
                        </li>
                        <li>
                            <a href="#">Legal Notice</a>
                        </li>
                        <li>
                            <a href="#">Terms And Conditions</a>
                        </li>
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Secure Payment</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white txt-md">SERVICES</h3>
                    <hr class="w-4 mt-2 mb-4 bg-red-500">
                    <ul class="flex flex-col justify-start gap-2 text-gray-500">
                        <li>
                            <a href="#">Prices Drop</a>
                        </li>
                        <li>
                            <a href="#">New Products</a>
                        </li>
                        <li>
                            <a href="#">Best Sales</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                        <li>
                            <a href="#">Sitemap</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-white txt-md">CONTACT</h3>
                    <hr class="w-4 mt-2 mb-4 bg-red-500">
                    <ul class="flex flex-col justify-start gap-2 text-gray-500">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <a href="#">100 kb road , Dhaka Bangladesh</a>
                        </li>
                        <li><i class="fa-solid fa-phone"></i>
                            <a href="#">08387434745</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="#">123sjhd@gmail.com</a>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex items-start justify-start my-10 text-center lg:justify-center lg:my-0">
                <p class="text-sm text-gray-400 ">&copy; 20<?php echo date('y'); ?> Crescent. All rights reserved.</p>
            </div>
        </div>
    </div>



    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> --}}
    </script>

    <script src="{{ asset('frontend') }}/index.js"></script>
    @yield('footer_content')


</body>

</html>
@yield('footer_content')
