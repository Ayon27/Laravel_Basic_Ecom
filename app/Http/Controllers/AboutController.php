<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //

    public function index()
    {
        $abouts = About::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function add()
    {
    }
}
