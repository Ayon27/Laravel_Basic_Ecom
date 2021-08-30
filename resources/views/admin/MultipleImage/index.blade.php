@extends('admin.body.admin_template')

@section('admin_index')

<div class="container">

    {{-- All Images --}}
    <div class="row mt-5">

        <div class="col-md-9">

            <div class="card-group" style="overflow-y: hidden">


                @foreach ($images as $image)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <img src="{{ asset($image->image) }}" alt="" class="">
                    </div>
                </div>

                @endforeach

            </div>
        </div>


        {{-- Add Image --}}


        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center"><b> Upload Muiltiple Image </b></div>
                <div class="card-body">
                    <form action="{{ route('storeMultipleImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @error('image')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="addImage">Brand Image</label>
                            <input type="file" class="" id="addImage" name="image[]" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection
