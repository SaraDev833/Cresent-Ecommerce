@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Deals of the Day</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Product Name</th>
                                <th>Staring Date</th>
                                <th>Ending Date</th>
                            </tr>
                            @foreach ($deals as $deal)
                                <tr>
                                    <td>{{ $deal->product_name }}</td>
                                    <td>{{ $deal->start_date }}</td>
                                    <td>{{ $deal->end_date }}</td>
                                    <td><a href="{{ route('deal.delete', $deal->id) }}" class="btn btn-danger">Delete</a>
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
                        <h2 class="text-lg font-semibold">Deal of the Day</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('add.deal', $product->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" class="form-control" value="{{ $product->product_name }}"
                                    name="product_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Starting date</label>
                                <input type="date" class="form-control" name="starting_date">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ending date</label>
                                <input type="date" class="form-control" value="" name="ending_date">
                            </div>
                            <div class="nb-3">
                                <button class="btn btn-secondary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
