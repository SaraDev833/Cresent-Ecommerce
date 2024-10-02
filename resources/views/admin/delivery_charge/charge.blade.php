@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold">Delivery Charge</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Location</th>
                                <th>Charge</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($charges as $charge)
                                <tr>
                                    <td>{{ $charge->location }}</td>
                                    <td>{{ $charge->charge }}</td>
                                    <td><a href="{{ route('charge.delete', $charge->id) }}" class="btn btn-danger">Delete</a>
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
                        <h3 class="text-lg font-semibold">Add Delivery Charge</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.charge') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Charge</label>
                                <input type="number" class="form-control" name="charge">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Charge</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
