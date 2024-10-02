@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Category List</h2>
                    </div>
                    <div class="card-body">
                        @if (session('not_found'))
                            <div class="alert alert-danger">{{ session('not_found') }}</div>
                        @endif
                        @if (session('deleted'))
                            <div class="alert alert-secondary">{{ session('deleted') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Category photo</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $sl => $category)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td><img src="{{ asset('uploads/category/' . $category->category_photo) }}"
                                            class="w-10 h-10 rounded-full" alt=""></td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('category.delete', $category->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Add Category</h2>
                    </div>
                    <div class="card-body">
                        @if (session('inserted'))
                            <div class="alert alert-secondary">{{ session('inserted') }}</div>
                        @endif
                        <form action="{{ route('add.category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category photo</label>
                                <input type="file" class="form-control" name="category_photo">

                            </div>
                            <div class="mb-3">
                                <button class="btn btn-secondary" type="submit">Add Category</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
