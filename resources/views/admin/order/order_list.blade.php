@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order Table</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Total</th>
                            <th>Delivery Charge</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $x => $order)
                            <tr>
                                <td>{{ $x + 1 }}</td>
                                <td>#{{ $order->order_id }}</td>
                                <td>{{ $order->rel_to_customer->name }}</td>
                                <td>{{ $order->total - $order->charge }}</td>
                                <td>{{ $order->charge }}</td>
                                <td>
                                    @if ($order->payment == 1)
                                        <span class="badge bg-primary">Cash on Delivery</span>
                                    @elseif ($order->payment == 2)
                                        <span class="badge bg-secondary">SSL</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 1)
                                        <span class="badge bg-primary">Placed</span>
                                    @elseif ($order->status == 2)
                                        <span class="badge bg-info">Processing</span>
                                    @elseif ($order->status == 3)
                                        <span class="badge bg-warning">Shipping</span>
                                    @elseif ($order->status == 4)
                                        <span class="badge bg-secondary">Ready To Deliver</span>
                                    @elseif ($order->status == 5)
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($order->status == 0)
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('order.status.update', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown
                                            </button>
                                            <ul class="dropdown-menu">
                                                <button name="status" value="1" class="dropdown-item"
                                                    type="submit">Placed</button>
                                                <button name="status" value="2" class="dropdown-item"
                                                    type="submit">Processing</button>
                                                <button name="status" value="3" class="dropdown-item"
                                                    type="submit">Shipping</button>
                                                <button name="status" value="4" class="dropdown-item"
                                                    type="submit">Ready to Deliver</button>
                                                <button name="status" value="5" class="dropdown-item"
                                                    type="submit">Delivered</button>
                                                <button name="status" value="0" class="dropdown-item"
                                                    type="submit">Cancel</button>
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
