@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Color Table</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $color->color_name }}</td>
                                    <td>
                                        @if ($color->color_name == 'N/A')
                                            N/A
                                        @else
                                            <span class="px-4 py-1"
                                                style="background-color: {{ $color->color_code }} ; color:transparent"></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delete.color', $color->id) }}" class="btn btn-danger">Delete</a>
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
                        <h2>Add Color</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.color') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Color Name</label>
                                <input type="text" class="form-control" name="color_name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Color Code</label>
                                <input type="color" class="form-control" name="color_code">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Color</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class=" row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h2>Size Table</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Size Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($sizes as $size)
                                        <tr>

                                            <td>
                                                @if ($size->size_name == 'N/A')
                                                    N/A
                                                @else
                                                    {{ $size->size_name }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('delete.size', $size->id) }}"
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
                                <h2>Add Size</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('add.size') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Size Name</label>
                                        <input type="text" class="form-control" name="size_name">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-secondary">Add Size</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
