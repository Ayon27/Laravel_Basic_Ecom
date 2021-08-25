<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>

    </x-slot>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center"><b> Edit Brand Details </b></div>
                    <div class="card-body">


                        <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$brand->brand_image}}" name="old_img">

                            @error('category_name')
                            <div class="card-text">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="brand_name">Update Brand name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name"
                                       value="{{ $brand->brand_name }}">
                            </div>
                            <div class="form-group">
                                <label for="updateBrandImage">Update Brand Image</label>
                                <input type="file" class="" id="updateBrandImage" name="brand_image" value="{{$brand->brand_image}}">

                            </div>
                            <div class="form-group">
                                <img src="{{asset($brand->brand_image)}}" alt="" class="img-thumbnail" style="max-width: 300px">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


