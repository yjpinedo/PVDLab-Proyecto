<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Employee;
use App\Teacher;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param User $entity
     */
    public function __construct(User $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request)
    {
        $user = User::where([
            ['model_id', $request->input('beneficiary_id')],
            ['model_type', 'App\Beneficiary']
        ])->first();

        if (!is_null($user)) {
            $beneficiary = Beneficiary::whereId($request->input('beneficiary_id'))->first();
            if (count($user->getRoleNames()) > 0) {
                foreach ($user->getRoleNames() as $roles) {
                    $user->removeRole($roles);
                }
            }
            if ($request->input('role') == 'teachers') {
                $teacher = Teacher::create([
                    "document_type" => $beneficiary->document_type,
                    "document" => $beneficiary->document,
                    "name" => $beneficiary->name,
                    "last_name" => $beneficiary->last_name,
                    "birth_date" => $beneficiary->birth_date,
                    "sex" => $beneficiary->sex,
                    "address" => $beneficiary->address,
                    "neighborhood" => $beneficiary->neighborhood,
                    "phone" => $beneficiary->phone,
                    "cellphone" => $beneficiary->cellphone,
                    "email" => $beneficiary->email,
                ]);
                $user->model_id = $teacher->id;
                $user->model_type = 'App\Teacher';
            } else if ($request->input('role') == 'employees') {
                $employee = Employee::create([
                    "document_type" => $beneficiary->document_type,
                    "document" => $beneficiary->document,
                    "name" => $beneficiary->name,
                    "last_name" => $beneficiary->last_name,
                    "birth_date" => $beneficiary->birth_date,
                    "sex" => $beneficiary->sex,
                    "address" => $beneficiary->address,
                    "neighborhood" => $beneficiary->neighborhood,
                    "phone" => $beneficiary->phone,
                    "cellphone" => $beneficiary->cellphone,
                    "email" => $beneficiary->email,
                ]);
                $user->model_id = $employee->id;
                $user->model_type = 'App\Employee';
            }
            $beneficiary->delete();
            $user->save();
            $user->assignRole($request->input('role'));
            return response()->json([
                'data' => $user,
                'message' => __('app.messages.users.assign'),
                'reload' => false,
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => __('app.messages.users.error'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     * */

    public function getRoles(): JsonResponse
    {
        return response()->json(Role::pluck('name', 'name')->all());
    }
}
