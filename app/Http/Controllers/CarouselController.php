<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\MultiImageUpload;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carousels = Carousel::latest()->paginate(5);
        return view('admin.carousel.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $validate_carousel = $request->validate([
            'desc' => 'max:250',
            'image' => 'required|mimes:jpg,jpeg,png'
        ], [
            'desc.max' => 'Description must not exceed 250 characters'
        ]);

        $carousel = new Carousel();

        $carousel->title = $request->title;
        $carousel->desc = $request->desc;
        $carousel->created_at = Carbon::now();

        $image = $request->file('image');

        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1080)->save(public_path('img/carousels/' . $name_gen));
            $img_loc = 'img/carousels/' . $name_gen;

            $carousel->image = $img_loc;
        }
        $this->store($carousel);

        return redirect()->back()->with('success', 'Slider Inserted Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($dataToStore)
    {
        //

        $dataToStore->save();
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $carousel = Carousel::find($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate_carousel = $request->validate([
            'desc' => 'max:250',
            // 'image' => 'mimes:jpg,jpeg,png'
        ], [
            'desc.max' => 'Description must not exceed 250 characters'
        ]);


        $old_img = $request->old_img;

        $image = $request->file('image');

        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1080)->save(public_path('img/carousels/' . $name_gen));
            $img_loc = 'img/carousels/' . $name_gen;

            unlink(public_path($old_img));
        } else {
            $img_loc = $old_img;
        }

        Carousel::find($id)->update([

            'title' => $request->title,
            'desc' => $request->desc,
            'image' => $img_loc,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('carousel.all')->with('success', 'Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {

        $carousel = Carousel::find($id);

        $old_img = $carousel->image;

        unlink(public_path($old_img));

        Carousel::find($id)->delete();

        return redirect()->route('carousel.all')->with('success', 'Slider Deleted Successfully');
    }
}
