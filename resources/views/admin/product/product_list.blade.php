@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-semibold">Product List</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Product name</th>
                        <th>SKU</th>
                        <th>Tags</th>
                        <th>preview</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr style="padding: 10px , 0">
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>
                                @php
                                    $explode = explode(',', $product->tag_id);
                                @endphp
                                @foreach ($explode as $tag)
                                    <span class="px-1 py-1 mt-4 rounded-full"
                                        style="background-color: rgb(205, 205, 205); ">{{ App\Models\Tag::find($tag)->tag_name }}</span>
                                @endforeach
                            </td style='display:flex ; justify-content:center ; align-items:center'>
                            <td><img src="{{ asset('uploads/products/preview/' . $product->preview) }}" height="50px"
                                    width="50px" style="border-radius:100%;" alt=""></td>
                            <td><a href="{{ route('product.view', $product->id) }}"><i class="p-2 fa-regular fa-eye"
                                        style="background: rgb(205, 205, 205)" title="view"></i></a>
                                <a href="{{ route('product.delete', $product->id) }}"><i class="p-2 fa-solid fa-trash"
                                        style="color: crimson ;background: rgb(205, 205, 205)" title="Delete"></i></a>
                                <a href="{{ route('inventory', $product->id) }}"><i class="p-2 fa-solid fa-warehouse"
                                        style="background: rgb(205, 205, 205)" title="Inventory"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
