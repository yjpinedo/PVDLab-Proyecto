<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Teacher $entity
     */
    public function __construct(Teacher $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.teachers';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();

            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.employee.teachers'),
                    'subtitle' => __('app.titles.employee.teachers'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['document', 'name', 'title', 'title_type'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);

                //$request->request->add(['employee_id' => $employee->id]);
                $this->model = $this->entity->orderBy('created_at', 'DESC');

                return $next($request);
            }

            return abort(404);
        });
    }
}
