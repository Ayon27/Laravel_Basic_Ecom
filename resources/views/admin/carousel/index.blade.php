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
                    <b> All Slides</b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Added on</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carousels as $carousel )
                            <tr>
                                <th scope="row">{{ $carousels->firstItem()+$loop->index }}</th>
                                <td>{{ $carousel->title }}</td>
                                <td>{{ $carousel->desc }}</td>
                                <td><img src="{{ asset($carousel->image) }}" class="img" alt="logo"
                                        style="max-height: 100px; max-width: 100px">
                                </td>
                                <td>
                                    @if ($carousel->created_at === NULL)
                                    <span class="text-warning">Not Found</span>
                                    @else
                                    {{ $carousel->created_at }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/carousel/edit/'.$carousel->id) }}" class="">Edit</a>
                                    <a href="{{ url('admin/carousel/delete/'.$carousel->id) }}" class="">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    {{ $carousels->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>


        {{-- Add Carousel --}}


        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><b> Add Slide </b></div>
                <div class="card-body">
                    <form action="{{ route('carousel.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @error('title')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                        </div>

                        @error('desc')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id="desc" name="desc" placeholder="Description"></textarea>
                        </div>

                        @error('image')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>

                        @enderror
                        <div class="form-group">
                            <label for="image">Slider Image</label>
                            <input type="file" class="" id="image" name="image">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Slide</button>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
