<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    //constructor. enforces auth
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //uses eloquent relation method
        $categories = Category::latest()->paginate(5);

        // //classic join query
        // $categories = Category::select('user_id', 'category_name', 'categories.created_at', 'categories.updated_at', 'users.name')
        //     ->leftjoin('users', 'users.id', '=', 'categories.user_id')->paginate(3);

        $deletedCategories = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index', compact('categories', 'deletedCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $validate_category = $req->validate([
            'category_name' => 'required|unique:categories|max:30',
        ], [
            'category_name.required' => 'Category must be filled'
        ]);

        //functional approach
        // Category::insert([
        //     'category_name' => $req->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //OOP approach
        $category = new Category();
        $category->category_name = $req->category_name;
        $category->user_id = Auth::user()->id;
        $category->created_at = Carbon::now();

        //invoke store
        $this->store($category);

        return Redirect()->route('allCategories')->with('success', 'Category Inserted Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($category)
    {
        //save object
        $category->save();

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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
        $request->validate([
            'category_name' => 'required|unique:categories|max:30'
        ]);

        Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('allCategories')->with('success', 'Category updated successfully');
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

    public function softDelete($id)
    {
        //
        $delete =  Category::find($id)->delete();

        return redirect()->route('allCategories')->with('success', 'Category Removed Successfully.');
    }


    //retore previously deleted entry
    public function restoreDeleted($id)
    {
        $deletedCategory = Category::withTrashed()->find($id)->restore();

        return Redirect()->route('allCategories')->with('success', 'Category Restored Successfully');
    }

    //permanently delete entry
    public function permanentDelete($id)
    {
        $permaDelete = Category::onlyTrashed($id)->forceDelete();

        return Redirect()->route('allCategories')->with('success', 'Category Permanently Deleted');
    }
}
