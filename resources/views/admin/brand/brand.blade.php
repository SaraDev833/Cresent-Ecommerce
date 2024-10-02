@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Brand List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><a href="#"><i class="fa-solid fa-trash" style="color: crimson"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Brand</h2>
                    </div>
                    <div class="card-body">
                        @if (session('added'))
                            <div class="alert alert-secondary">{{ session('added') }}</div>
                        @endif
                        <form action="{{ route('add.brand') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="brand_name">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
