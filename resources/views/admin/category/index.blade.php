@extends('admin.body.admin_template')

@section('admin_index')

<div class="container">

    {{-- All Categories --}}
    <div class="row mt-5">
        <div class="col-md-9">
            <div class="card" style="overflow-y: hidden">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>
                        {{ session('success') }}
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-header">
                    <b> All Categories</b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category )
                            <tr>
                                <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    @if ($category->created_at == NULL)
                                    <span class="text-warning">Not Found</span>
                                    @else
                                    {{ $category->created_at }}
                                    @endif
                                </td>
                                <td>{{ $category->user->name }}</td>
                                <td>
                                    <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('category/delete/'.$category->id) }}"
                                        class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        {{-- Add Category --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><b> Add Category </b></div>
                <div class="card-body">
                    <form action="{{ route('addCategory') }}" method="POST">
                        @csrf
                        @error('category_name')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="addCategory">Category name</label>
                            <input type="text" class="form-control" id="addCategory" name="category_name"
                                placeholder="Category Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Deleted Categories --}}
    <div class="row mt-5">
        <div class="col-md-9">
            <div class="card mb-5" style="overflow-y: hidden">
                <div class="card-header">
                    <b> Deleted Categories</b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Added by</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deletedCategories as $category )
                            <tr>
                                <th scope="row">{{ $deletedCategories->firstItem()+$loop->index }}</th>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    @if ($category->created_at == NULL)
                                    <span class="text-warning">Not Found</span>
                                    @else
                                    {{ $category->created_at }}
                                    @endif
                                </td>
                                <td>{{ $category->user->name }}</td>
                                <td>
                                    <a href="{{ url('category/restore/'.$category->id) }}"
                                        class="btn btn-success">Restore</a>
                                    <a href="{{ url('category/delete_perma/'.$category->id) }}"
                                        class="btn btn-danger">Delete
                                        Permanently</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    {{ $deletedCategories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
