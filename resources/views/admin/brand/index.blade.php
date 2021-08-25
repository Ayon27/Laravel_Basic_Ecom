<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>

    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}

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
                        <b> All Brands</b>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand )
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" class="img-thumbnail" alt="logo"
                                            style="max-height: 50px; max-width: 50px">
                                    </td>
                                    <td>
                                        @if ($brand->created_at === NULL)
                                        <span class="text-warning">Not Found</span>
                                        @else
                                        {{ $brand->created_at }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('brand/delete/'.$brand->id) }}"
                                            class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>


            {{-- Add Brand --}}


            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center"><b> Add Brand </b></div>
                    <div class="card-body">
                        <form action="{{ route('addBrand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @error('brand_name')
                            <div class="card-text">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="addBrandName">Brand name</label>
                                <input type="text" class="form-control" id="addBrandName" name="brand_name"
                                    placeholder="Brand Name">
                            </div>
                            <div class="form-group">
                                <label for="addBrandImage">Brand Image</label>
                                <input type="file" class="" id="addBrandImage" name="brand_image">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>

        {{-- Deleted Categories --}}
        {{-- <div class="row mt-5">
            <div class="col-md-9">
                <div class="card" style="overflow-y: hidden">
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
            <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-success">Restore</a>
            <a href="{{ url('category/delete_perma/'.$category->id) }}" class="btn btn-danger">Delete
                Permanently</a>
        </td>
        </tr>
        @endforeach
        </table>
        {{ $deletedCategories->links() }}
    </div>
    </div>
    </div>
    </div> --}}

    </div>



</x-app-layout>
