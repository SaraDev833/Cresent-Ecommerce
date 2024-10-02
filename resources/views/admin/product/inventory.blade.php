@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Inventory List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>After Discount Price</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->rel_to_product->product_name }}</td>
                                    <td>{{ $inventory->rel_to_color->color_name }}</td>
                                    <td>{{ $inventory->rel_to_size->size_name }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                    <td>{{ $inventory->price }}</td>
                                    <td>{{ $inventory->rel_to_product->discount }}</td>
                                    <td>{{ $inventory->after_discount_price }}</td>
                                    <td><a href="{{ route('delete.inventory', $inventory->id) }}"
                                            class="btn btn-danger">Delete</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-xl">Product Inventory</h2>
                    </div>
                    <div class="card-body">
                        @if (session('added'))
                            <div class="alert alert-secondary">{{ session('added') }}</div>
                        @endif
                        <form action="{{ route('add.inventory', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_id" disabled
                                    value="{{ $product->product_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Select Color</label>
                                <select name="color_id" name="color_id" id="" class="form-control">
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Select Size</label>
                                <select name="size_id" name="size_id" id="" class="form-control">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Inventory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
