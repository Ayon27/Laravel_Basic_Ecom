<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $validate_brand =  $request->validate([
            'brand_name' => 'required|unique:brands|max:30',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
        ], [
            'brand_name.required' => 'Please enter brand name',
            'brand_image.required' => 'Please select an image'
        ]);

        //functional approach
        // Brand::insert([
        //     'brand_name' => $request->brand_name,
        //     'created_at' => Carbon::now()
        // ]);

        //OOP approach
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        // $brand->user_id = Auth::user()->id;
        $brand->created_at = Carbon::now();

        $brand_image = $request->file('brand_image');


        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_loc = 'img/brand/';
        $last_img = $up_loc . $img_name;

        $brand_image->move($up_loc, $img_name);

        $brand->brand_image = $last_img;

        //invoke store
        $this->store($brand);

        return Redirect()->route('allBrand')->with('success', 'Brand Inserted Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($brand)
    {
        //
        $brand->save();
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
}