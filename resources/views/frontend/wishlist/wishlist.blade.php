@extends('frontend.master')
@section('frontend_content')
    <!-- wishlist content---->
    <div class="container mt-10 mb-10 mobile-container">
        <h2 class="mb-8 text-2xl font-semibold leading-10 text-left text-slate-800 title ">Wishlist
        </h2>

        <div class="mt-10 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Product</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Price</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Stock Status</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase t whitespace-nowrap">
                            Action</th>
                        <th
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase whitespace-nowrap">
                            Remove</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($wishlists as $wishlist)
                        <tr>
                            <td class="flex items-center gap-2 px-6 py-4 ">
                                <img src="{{ asset('uploads/products/preview/' . $wishlist->rel_to_product->preview) }}"
                                    class="object-cover h-12 rounded-md w-14" alt="ChicWave Ladies' Tshirt">
                                @php
                                    $length = $wishlist->rel_to_product->product_name;
                                @endphp
                                <h2 class="text-lg font-semibold text-gray-700 whitespace-nowrap">
                                    {{ $length >= 25 ? Str::substr($length, 0, 25) . '...' : $wishlist->rel_to_product->product_name }}
                                    <br>
                                </h2>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                ${{ $wishlist->rel_to_product->rel_to_inventory->first()->after_discount_price }}</td>
                            @if ($wishlist->rel_to_product->rel_to_inventory->first()->quantity != 0)
                                <td class="px-6 py-4 whitespace-nowrap">In Stock</td>
                            @else
                                <td class="px-6 py-4 whitespace-nowrap">Restocking soon</td>
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('view.product', $wishlist->rel_to_product->slug) }}"
                                    class="px-2 py-1 border-b border-red-500 whitespace-nowrap">View Product</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('remove.wishlist', $wishlist->id) }}"><i
                                        class="text-xl text-red-400 fa-solid fa-trash"></i></a>
                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="5" class="py-4 text-lg font-semibold text-center">No product found on wishlist!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
