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
                                    <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger">Remove</a>
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
                        @error('brand_image')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
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
</div>

@endsection
