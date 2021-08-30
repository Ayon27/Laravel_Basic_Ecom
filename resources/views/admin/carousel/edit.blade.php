@extends('admin.body.admin_template')


@section('admin_index')

<div class="container">
    <div class="row mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center"><b> Edit Carousel </b></div>
                <div class="card-body">


                    <form action="{{ url('admin/carousel/update/'.$carousel->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$carousel->image}}" name="old_img">



                        <div class="form-group">
                            <label for="carouselTitle">Update Carousel Title</label>
                            <input type="text" class="form-control" id="carouselTitle" name="title" placeholder=""
                                value="{{ $carousel->title }}">
                        </div>

                        @error('desc')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="carouselDesc">Update Carousel Description</label>
                            <textarea type="input" class="form-control" id="carouselDesc" name="desc" placeholder=""
                                style="min-height: 10vmax">{{ $carousel->desc }} </textarea>
                        </div>


                        @error('image')
                        <div class="card-text">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror


                        <div class="form-group">
                            <label for="carouselImg">Update Carousel Image</label>
                            <input type="file" class="" id="carouselImg" name="image" placeholder=""
                                value="{{$carousel->image}}">
                        </div>

                        <div class="form-group">
                            <img src="{{asset($carousel->image)}}" alt="" class="" style="max-width: 300px">
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



@endsection
