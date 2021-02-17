<?php

namespace App\Http\Controllers\Employee;

use App\Course;
use App\Employee;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.courses';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();

            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.employee.courses'),
                    'subtitle' => __('app.titles.employee.courses'),
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'teacher_id', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [
                        [
                            'name' => 'teacher_id',
                            'type' => 'select_reload',
                        ],
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                        ],
                        [
                            'name' => 'format_slug',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'state',
                            'type' => 'select',
                            'value' => 'app.selects.course.state',
                        ],
                    ],
                ]]);

                //$request->request->add(['employee_id' => $employee->id]);
                $this->model = $this->entity->orderBy('created_at', 'DESC')->with('teacher');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return JsonResponse
     */
    public function store(CourseRequest $request)
    {
        $lastId = Course::all()->last()->id;
        $request['code'] = 'CUR - ' . ($lastId + 1);
        $request['slug'] = $request->root() . "/beneficiary/courses_lists/" . ($lastId + 1) . "/application_course";
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CourseRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
