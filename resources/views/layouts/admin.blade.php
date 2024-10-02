<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Tailwind CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.4.2/tailwind.min.css"> --}}
    {{-- bootsrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend') }}/output.css">
    <style>
        /* Sidebar styles */
        .side-navbar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            background-color: #fffefe;
        }

        .side-navbar.open {
            transform: translateX(0);
        }

        .main-content {
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .main-content.with-sidebar {
            margin-left: 16rem;
            width: calc(100% - 16rem);
        }

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

        .response {
            position: relative;
        }

        .response .eye {
            position: absolute;
            top: 50%;
            transform: translateY(-8%);
            right: 0px;
            background-color: gray;
            padding: 10px 10px;
            border-radius: 10px color: white;
        }
       .overflow-y::-webkit-scrollbar-thumb{
            width: 1px;
        }
        #side-navbar::-webkit-scrollbar-thumb{
            width: 1px !important;
        }
    </style>
</head>

<body class="flex flex-col h-screen">
    <!-- Top Navbar -->
    <header class="flex items-center justify-end p-4 pr-4 text-white bg-gray-400">

        <div class="relative px-4 space-x-3 pr-7 group">
            <div class="flex items-center justify-end space-x-4">
                @if (Auth::user()->photo == null)
                    <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"
                        class="w-10 h-10 border-gray-800 border-none rounded-full outline-none border-1" alt="">
                @else
                    <img src="{{ asset('uploads/users/' . Auth::user()->photo) }}"
                        class="w-10 h-10 border-gray-800 border-none rounded-full outline-none border-1" alt="">
                @endif
                <span class="text-sm font-semibold text-white">{{ Auth::user()->name }}</span>
            </div>
            <div
                class="absolute right-0 z-50 flex-col hidden w-48 bg-white border border-b rounded-md shadow top-full group-hover:block">
                <a href="{{ route('edit.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit
                    Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a>

                </form>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="flex flex-1">
        <!-- Side Navbar -->
        <nav id="side-navbar"
            class="fixed top-0 left-0 z-50 flex-shrink-0 w-64 h-full p-5 overflow-y-auto bg-white text-slate-600 side-navbar">
            <div class="flex items-center ">
                <button id="close-sidebar" class="text-xl text-gray-400 hover:text-gray-900">
                    {{-- <i class="fa-solid fa-xmark"></i> --}}
                </button>


            </div>
            <a href="{{ route('dashboard') }}"
                class="pb-3 text-3xl font-semibold text-gray-600 border-b border-gray-800">Cresent</a>
            <div>
                <!-- Sidebar Content -->
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('edit.profile') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Edit
                            Profile</a>
                        <a href="{{ route('user.list') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">User
                            list
                        </a>

                        <summary class="pt-3 text-lg font-semibold text-slate-700">User</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('category') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Category</a>

                        <a href="{{ route('subcategory') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">SubCategory
                        </a>
                        <a href="{{ route('subcategory.item') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">SubCategory items
                        </a>

                        <summary class="pt-3 text-lg font-semibold text-slate-700">Category</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('brand') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Brand</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Brand</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('tag') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Tags</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Tags</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('product') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Add
                            Product</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Product</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('variation') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Add
                            variation</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Variation</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('banner') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">Add
                            Banner</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Banner</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('deal') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">
                            Deal of the day</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Deals </summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('coupon') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">
                           Coupon</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Add Coupon</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('charge') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">
                           Deliver Charge</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Delivery</summary>
                    </details>

                </div>
                <div class="pt-3 pb-3 text-gray-600 border-b border-gray-800 mobile_nav_items">
                    <details class="flex flex-col gap-2 ">
                        <a href="{{ route('order.list') }}"
                            class="inline-block pb-1 text-sm font-semibold border-gray-700 text-slate-500 hover:text-sky-600">
                           Order</a>



                        <summary class="pt-3 text-lg font-semibold text-slate-700">Order</summary>
                    </details>

                </div>
        </nav>

        <!-- Main Content -->
        <main id="main-content" class="flex-1 p-6 ml-0 bg-gray-100 main-content">
            <button id="toggle-sidebar"
                class="absolute z-50 p-2 text-white bg-gray-600 rounded top-4 left-4 hover:bg-gray-500">
                <i class="fa-solid fa-list"></i>
            </button>

            @yield('content')

        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    <script>
        const sidebar = document.getElementById('side-navbar');
        const mainContent = document.getElementById('main-content');
        const toggleButton = document.getElementById('toggle-sidebar');
        const closeButton = document.getElementById('close-sidebar');

        function toggleSidebar() {
            if (sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
                mainContent.classList.remove('with-sidebar');
            } else {
                sidebar.classList.add('open');
                mainContent.classList.add('with-sidebar');

            }
        }

        // Toggle sidebar on button click
        toggleButton.addEventListener('click', toggleSidebar);

        // Close sidebar on close button click
        closeButton.addEventListener('click', function() {
            sidebar.classList.remove('open');
            mainContent.classList.remove('with-sidebar');
        });
    </script>
    @yield('footer_script')
</body>

</html>
