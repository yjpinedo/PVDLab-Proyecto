<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
//use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        return view('home');
//        if (Auth::user()->hasRole('Admin')) return redirect()->route('teachers.index');
//        if (Auth::user()->hasRole('Students')) return redirect()->route('teachers.index');
//        if (Auth::user()->hasRole('Teachers')) return redirect()->route('teachers.index');
//        else return redirect()->route('teachers.index');
    }
}
