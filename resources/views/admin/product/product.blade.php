@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content:space-between">
                        <h2 class="text-lg font-semibold">Add New Product</h2>
                        <a href="{{ route('product.list') }}" class="btn btn-secondary">Product List</a>
                    </div>
                    <div class=" card-body">
                        @if (session('added'))
                            <div class="alert alert-secondary">{{ session('added') }}</div>
                        @endif
                        <form action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Select subcategory</label>
                                    <select name="subcategory_id" id="subcategory" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Select item</label>
                                    <select name="items_id" id="item" class="form-control">
                                        <option value="">Select Item</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->sub_item_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" class="form-control " name="product_name">
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Brand Name</label>
                                    <select name="brand" class="form-control" id="">
                                        <option value="">Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku">
                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="" class="form-label">Discount</label>
                                    <input type="number" class="form-control" name="discount">
                                </div>
                                <div class="mb-3 col-lg-8">
                                    <label for="" class="form-label">Short Description</label>
                                    <input type="text" class="form-control" name="short_desp">
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="" class="form-label">Long Description</label>
                                    <textarea name="long_desp" id="summernote" cols="30" rows="10" style="width: inherit" class="form-control"></textarea>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="" class="form-label">Select Tag</label>
                                    <select id="remove-button" multiple name="tag_id[]">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="" class="form-label">Preview</label>
                                    <input type="file" class="form-control" name="preview">
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="" class="form-label">Gallery</label>
                                    <input type="file" class="form-control" name="gallery[]" multiple>
                                </div>

                            </div>
                            <div class="mb-3 col-lg-12 text-end">
                                <button type="submit" class="btn btn-secondary">Add Product</button>
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
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        $("#remove-button").selectize({
            plugins: ["remove_button"],
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>
    <script>
        $('#category_id').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getSubcategories',
                data: {
                    'category_id': category_id
                },
                success: function(data) {
                    $('#subcategory').html(data);
                }
            })
        })
    </script>
    <script>
        $('#subcategory').change(function() {
            var subcategory_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/getItems',
                data: {
                    'subcategory_id': subcategory_id
                },
                success: function(data) {
                    $('#item').html(data);
                }
            })

        })
    </script>
@endsection
