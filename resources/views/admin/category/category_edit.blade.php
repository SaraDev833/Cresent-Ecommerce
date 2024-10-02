@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="m-auto col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Edit Category</h2>
                    </div>
                    <div class="card-body">
                        @if (session('updated'))
                            <div class="alert alert-secondary">{{ session('updated') }}</div>
                        @endif
                        <form action="{{ route('category.update', $category->id) }}" method="POSt"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name"
                                    value="{{ $category->category_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category Photo</label>
                                <input type="file" class="form-control" name="category_photo"
                                    value="{{ $category->category_photo }}"
                                    onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                                <div class="my-1">
                                    <img src="{{ asset('uploads/category/' . $category->category_photo) }}" width="100px"
                                        height="100px" alt="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-secondary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
