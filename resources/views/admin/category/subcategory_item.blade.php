@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Subcategory Item</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Subcategory Item Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    @php
                                        $subcategories = App\Models\Subcategory::where(
                                            'category_id',
                                            $category->id,
                                        )->get();
                                    @endphp
                                    @foreach ($subcategories as $subcategory)
                                        @php
                                            $items = App\Models\SubcategoryItem::where(
                                                'subcategory_id',
                                                $subcategory->id,
                                            )->get();
                                        @endphp
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $subcategory->subcategory_name }}</td>
                                                <td>{{ $item->sub_item_name }}</td>
                                                <td><a href="{{ route('item.delete', $item->id) }}"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-xl font-semibold">Subcategory Item</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('add.subategory.item') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Category name</label>
                                <Select class="form-control" name="category_id" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </Select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Subcategory name</label>
                                <Select class="form-control" name="subcategory_id" id="subcategory">
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach
                                </Select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Subcategory Item name</label>
                                <input type="text" class="form-control" name="item_name">
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
@section('footer_script')
    <script>
        $('#category').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/get/subcategory',
                data: {
                    'category_id': category_id
                },
                success: function(data) {
                    $('#subcategory').html(data);
                }
            })
        })
    </script>
@endsection
