<?php

namespace App\Http\Controllers\Employee;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function index()
    {
        return view('employees.update-password');
    }

    public function store(Request $request)
    {
        $response = [];
        $user = User::where('model_id', Auth::user()['model_id'])->first();

        $request->validate([
            'password-current' => ['required'],
            'password' => ['required', 'regex:/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', 'min:6', 'confirmed'],
        ], ['password.regex' => 'El campo contraseña debe tener al menos una letra minuscula, mayuscula, número y/o caracter especial']);

        if (Hash::check($request->input('password-current'), $user->password)) {
            $user->password = Hash::make(implode($request->only('password')));
            $user->save();
            $response = [
                'data' => $user,
                'message' => 'La contraseña ha sido actualizada con exito',
                'reload' => false,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'La contraseña actual no es correcta.',
                'reload' => false,
            ];
        }

        return response()->json($response);
    }
}
