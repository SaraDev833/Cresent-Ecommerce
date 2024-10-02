@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Banner List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Banner Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->small_text }}</td>
                                    <td><img src="{{ asset('uploads/banner/' . $banner->banner_image) }}" height="100px"
                                            width="100px" alt=""></td>
                                    <td><a href="{{ route('banner.delete', $banner->id) }}"
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
                        <h2 class="text-xl font-semibold">Add Banner</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.banner') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Large Text</label>
                               <input type="text" class="form-control"  name="large_text">
                            </div> --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Banner Title</label>
                                <input type="text" class="form-control" name="small_text">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Banner Image</label>
                                <input type="file" class="form-control" name="banner">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
