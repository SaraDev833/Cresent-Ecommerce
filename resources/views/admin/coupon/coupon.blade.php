@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Coupon List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Coupon Name</th>
                                <th>Coupon Type</th>
                                <th>Amount</th>
                                <th>Minimum purchase</th>
                                <th>Validity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->coupon_type == 1 ? 'percentage' : 'Solid' }}</td>
                                    <td>{{ $coupon->amount }}</td>
                                    <td> {{ $coupon->min_purchase }}</td>
                                    <td> {{ $coupon->validity }}</td>
                                    <td><a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-danger">Delete</a>
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
                        <h2 class="text-lg font-semibold">Add Coupon</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.coupon') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" name="coupon_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Coupon Type</label>
                                <select name="coupon_type" class="form-control">
                                    <option value="1">Percentage</option>
                                    <option value="2">Solid</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Minimum purchase</label>
                                <input type="number" class="form-control" name="min_purchase">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Validity</label>
                                <input type="date" class="form-control" name="validity">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
