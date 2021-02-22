<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Position;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('employees.profile', [
            'employee' => $employee = Employee::whereId(Auth::user()['model_id'])->with('position')->first(),
            'positions' => Position::pluck('name', 'id')->all(),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        $id = Auth::user()['model_id'];
        $user = User::where('model_id', $id)->first();
        $user_id = 0;

        if (!is_null($user)){
            $user_id = $user->id;
        }

        $request->validate([
            'document_type' => 'required',
            'document' => 'required|numeric|digits_between:6,12|unique:employees,document,' . $id,
            'name' => 'required|min:3|max:50|alpha_space',
            'last_name' => 'required|min:3|max:50|alpha_space',
            'sex' => 'required|in:' . implode(',', array_keys(__('app.selects.person.sex'))),
            'birth_date' => 'required|date|before:today',
            'address' => 'required|min:3|max:50',
            'neighborhood' => 'required|min:3|max:50',
            'phone' => 'required_without:cellphone|numeric|digits_between:6,12|bail',
            'cellphone' => 'nullable|numeric|digits_between:6,12|bail',
            'email' => [
                'required',
                'email',
                Rule::unique('beneficiaries', 'email')->ignore($user_id),
                Rule::unique('employees', 'email')->ignore($id),
                Rule::unique('users', 'email')->ignore($user_id),
                Rule::unique('teachers', 'email')->ignore($user_id),
            ],
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee = Employee::find($id)->fill($request->all());
        $employee->save();

        if ($user->email != $employee->email) {
            $user->email = $employee->email;
            $user->save();
        }

        return response()->json([
            'data' => $employee,
            'message' => __('base.messages.update', ['name' => $employee->full_name]),
        ]);
    }
}
