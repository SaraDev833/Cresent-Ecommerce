@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Tag List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Tag Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($tags as $sl => $tag)
                                <tr>
                                    <td>{{ $tags->firstItem() + $sl }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>
                                        <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="m-4">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-lg font-semibold">Tag Name</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-secondary">{{ 'success' }}</div>
                        @endif
                        <form action="{{ route('insert.tag') }}" method="POST">
                            @csrf
                            <label for="" class="form-label">Tag Name</label>
                            <div id="inputContainer" class="mb-3">
                                <input type="text" class="mb-2 form-control" name="tag_name[]">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="my-4" style="display: flex ; justify-content:flex-end">
                                <button type="button" class="btn btn-light" onclick="addFn()">+Add input</button>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Add Tag</button>
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
        function addFn() {
            const container = document.getElementById('inputContainer');
            const inputCount = container.querySelectorAll('input').length;

            // Creating a new input field
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'tag_name[]';
            newInput.className = 'form-control mb-2';
            newInput.placeholder = 'Enter value';
            container.appendChild(newInput);
        }
    </script>
@endsection
