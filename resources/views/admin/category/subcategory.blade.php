@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="flex flex-wrap col-lg-8">
                @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-lg font-semibold">Category - {{ $category->category_name }}</h2>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <th>Subcategory Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach (App\Models\Subcategory::where('category_id', $category->id)->get() as $subcategory)
                                        <tr>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td><a href="{{ route('sub.delete', $subcategory->id) }}"><i
                                                        class=" fa-solid fa-trash"
                                                        style="color:crimson ; font-size:16px"></i></a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Add Subcategory</h2>
                    </div>
                    <div class="card-body">
                        @if (session('added'))
                            <div class="alert alert-secondary">{{ session('added') }}</div>
                        @endif
                        <form action="{{ route('add.subcategory') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Select Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control" name="subcategory">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-secondary" type="submit">Add Subcategory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
