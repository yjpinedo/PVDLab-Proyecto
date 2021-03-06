<?php

namespace App\Http\Controllers;

use App\Utils\Base;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirects to the home page according to the role of the user.
     *
     * @return Renderable
     */
    public function home()
    {
        if (Auth::user()->hasRole('beneficiaries')) return redirect()->route('beneficiary.projects.index');
        else if (Auth::user()->hasRole('teachers')) return redirect()->route('teacher.courses.index');
        else if (Auth::user()->hasRole('employees')) return redirect()->route('employee.projects.index');
        else if (Auth::user()->hasRole('admin')) return redirect()->route('projects.index');
        else return abort(404);
    }

    /**
       * Redirects to the home page according to the role of the user.
     *
     * @param Request $request
     * @return Renderable
     */
    public function select(Request $request)
    {
        $active = $bool = filter_var($request->input('active'), FILTER_VALIDATE_BOOLEAN);;

        $request->request->add(['data' => Base::select($request->input('name'), $active)]);

        return response()->json($request);
    }
}
