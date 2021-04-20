<?php

namespace App\Http\Controllers\Auth;

use App\Beneficiary;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * @var Beneficiary
     */
    private $entity;
    /**
     * @var string
     */
    private $crud;

    /**
     * Create a new controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        $this->entity = $entity;
        $this->crud = $this->entity->getTable();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'document_type' => ['required'],
            'document' => ['required', 'numeric', 'digits_between:6,12', 'unique:beneficiaries'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:50', 'alpha_space'],
            'sex' => ['required', 'in:' . implode(',', array_keys(__('app.selects.person.sex')))],
            'birth_date' => ['required', 'date', 'before:Today'],
            'place_of_birth' => ['required', 'min:3', 'max:50'],
            'address' => ['required', 'min:3', 'max:50'],
            'neighborhood' => ['required', 'min:3', 'max:50'],
            'cellphone' => ['nullable', 'numeric', 'digits_between:6,12', 'bail'],
            'phone' => ['required_without:cellphone', 'numeric', 'digits_between:6,12', 'bail'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'occupation' => ['min:3', 'max:200'],
            'ethnic_group' => ['required', 'in:' . implode(',', array_keys(__('app.selects.person.ethnic_group')))],
            'stratum' => ['required', 'in:' . implode(',', array_keys(__('app.selects.person.stratum')))],
            'password' => ['required', 'regex:/^(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', 'min:6', 'confirmed'],
        ], ['password.regex' => 'El campo contraseña debe tener al menos una letra minúscula, mayúscula, número y/o carácter especial']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $entity = $this->entity->create($data);

        $className = get_class($this->entity);

        $user = User::create([
            'name' => $entity->full_name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'model_type' => $className,
            'model_id' => $entity->id,
        ])->assignRole($this->crud);

        return $user;
    }
}
