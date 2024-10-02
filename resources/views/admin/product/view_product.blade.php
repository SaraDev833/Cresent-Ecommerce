@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-xl font-extrabold text-black">Product Detail</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <td>{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th>Product Code</th>
                        <td>{{ $product->sku }}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{{ $product->short_desp }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ $product->discount }}$</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->rel_to_cat->category_name }}</td>
                    </tr>
                    <tr>
                        <th>Subcategory</th>
                        <td>{{ $product->rel_to_subcat->subcategory_name }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td class="now-wrap"> {!! $product->long_desp !!}</td>
                    </tr>
                    <tr>
                        @php
                            $explode = explode(',', $product->tag_id);
                        @endphp
                        <th>Tags</th>
                        <td>
                            @foreach ($explode as $tag_id)
                                <span class="p-1"
                                    style="background: rgb(213, 211, 211)">{{ App\Models\Tag::find($tag_id)->tag_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Gallery</th>
                        <td style="display: flex;gap:10px ">
                            @forelse (App\Models\Gallery::where('product_id' , $product->id)->get() as $gallery)
                                <img src="{{ asset('uploads/products/galleries/' . $gallery->gallery_name) }}"
                                    height="50px" width="50px" style="border-radius: 100% ; " alt="">
                            @empty
                                <p>No image</p>
                            @endforelse

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
