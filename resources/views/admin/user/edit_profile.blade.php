@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold ">Edit Your name</h2>
                    </div>
                    <div class="card-body">
                        @if (session('name_changed'))
                            <div class="alert alert-secondary">
                                {{ session('name_changed') }}
                            </div>
                        @endif
                        <form action="{{ route('update.profile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class= "form-label">Your Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold">Change Your Password</h3>
                    </div>
                    <div class="card-body">
                        @if (session('dismatched'))
                            <div class="alert alert-secondary">{{ session('dismatched') }}</div>
                        @endif
                        @if (session('updated'))
                            <div class="alert alert-danger">{{ session('updated') }}</div>
                        @endif
                        <form action="{{ route('change.pass') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                @error('current_password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class= "form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password">

                            </div>
                            <div class="mb-3 response">
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class= "form-label">New Password</label>
                                <input type="password" class="form-control pass" name="password">
                                <i class="fa-regular fa-eye eye"></i>
                            </div>
                            <div class="mb-3">
                                @error('password_confirmation')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class= "form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Update Profile Photo</h2>
                    </div>
                    <div class="card-body">

                        @if (session('image'))
                            <div class="alert alert-secondary">{{ session('image') }}</div>
                        @endif
                        <form action="{{ route('update.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                @if (Auth::user()->photo != null)
                                    <div class="my-2">
                                        <img src="{{ asset('uploads/users/' . Auth::user()->photo) }}" id="blah"
                                            alt="" width="100px" height="100px">
                                    </div>
                                @endif
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
@section('footer_script')
    <script>
        $('.eye').click(function() {
            var input = $('.pass');
            var type = input.attr('type');

            if (type == 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        })
    </script>
@endsection
