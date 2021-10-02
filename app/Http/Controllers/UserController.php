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
        $this->model = $this->entity->where('id', '!=', 1)->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function store(Request $request): JsonResponse
    {
        $model = null;
        $user = User::whereId($request->input('user_id'))->first();
        if (!is_null($user)) {

            if ($user->model_type == 'App\Beneficiary') {
                $model = Beneficiary::whereId($user->model_id)->first();
            } elseif ($user->model_type == 'App\Employee') {
                $model = Employee::whereId($user->model_id)->first();
            } else {
                $model = Teacher::whereId($user->model_id)->first();
            }

            $input = [
                "document_type" => $model->document_type,
                "document" => $model->document,
                "name" => $model->name,
                "last_name" => $model->last_name,
                "birth_date" => $model->birth_date,
                "sex" => $model->sex,
                "address" => $model->address,
                "neighborhood" => $model->neighborhood,
                "phone" => $model->phone,
                "cellphone" => $model->cellphone,
                "email" => $model->email,
            ];

            if ($request->input('role') == 'teachers') {
                if ($user->model_type != 'App\Teacher') {
                    $haveTeacher = Teacher::whereDocument($model->document)->first();
                    if ($haveTeacher) {
                        $teacherId = $haveTeacher->id;
                    } else {
                        $teacher = Teacher::create($input);
                        $teacherId = $teacher->id;
                    }
                    $user->model_id = $teacherId;
                    $user->model_type = 'App\Teacher';
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => "El usuario $model->name ya cuenta con el rol docente",
                    ]);
                }
            } else if ($request->input('role') == 'employees') {
                if ($user->model_type != 'App\Employee') {
                    $haveEmployee = Employee::whereDocument($model->document)->first();
                    if ($haveEmployee) {
                        $employeeId = $haveEmployee->id;
                    } else {
                        $employee = Employee::create($input);
                        $employeeId = $employee->id;
                    }
                    $user->model_id = $employeeId;
                    $user->model_type = 'App\Employee';
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => "El usuario $model->name ya cuenta con el rol empleado",
                    ]);
                }
            } else {
                if ($user->model_type != 'App\Beneficiary') {
                    $haveBeneficiary = Beneficiary::whereDocument($model->document)->first();
                    if ($haveBeneficiary) {
                        $beneficiaryId = $haveBeneficiary->id;
                    } else {
                        $beneficiary = Beneficiary::create($input);
                        $beneficiaryId = $beneficiary->id;
                    }
                    $user->model_id = $beneficiaryId;
                    $user->model_type = 'App\Beneficiary';
                } else {
                    return response()->json([
                        'error' => true,
                        'message' => "El usuario $model->name ya cuenta con el rol beneficiario",
                    ]);
                }
            }

            if (count($user->getRoleNames()) > 0) {
                foreach ($user->getRoleNames() as $roles) {
                    $user->removeRole($roles);
                }
            }

            $user->save();
            $user->assignRole($request->input('role'));
            return response()->json([
                'data' => $user,
                'message' => __('app.messages.users.assign'),
                'reload' => false,
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('app.messages.users.error'),
            ]);
        }
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
