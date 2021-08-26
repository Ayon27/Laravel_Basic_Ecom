<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //    //constructor. enforces auth
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();

        return view('admin.index', compact('users'));
    }
}
