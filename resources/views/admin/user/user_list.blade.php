@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">User List</h2>
                    </div>
                    <div class="card-body">
                        @if (session('deleted'))
                            <div class="alert alert-secondary">{{ session('deleted') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $sl => $user)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->photo == null)
                                            <img src="{{ Avatar::create($user->name)->toBase64() }}"
                                                class="w-10 h-10 rounded-full" alt="">
                                        @else
                                            <img src="{{ asset('uploads/users/' . $user->photo) }}"
                                                class="w-10 h-10 rounded-full" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Delete</a>
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
                        <h2 class="text-xl font-semibold">Add User</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-secondary">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('insert.user') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label"> User Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">User Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
