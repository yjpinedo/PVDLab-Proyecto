<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CourseRequest;
use App\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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

        $this->crud = 'teacher.courses';

        $this->middleware(function ($request, $next) {
            $teacher = Teacher::where('id', Auth::user()['model_id'])->with('courses.teacher')->first();

            if ( !is_null($teacher) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                        ],
                        [
                            'name' => 'state',
                            'type' => 'select',
                            'value' => 'app.selects.course.state',
                        ],
                        [
                            'name' => 'format_slug',
                            'type' => 'text',
                        ],
                    ],
                ]]);

                $request->request->add(['teacher_id' => $teacher->id]);
                $this->model = $teacher->courses->sortByDesc('created_at');

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
        $lastId = Course::all()->last()->id ?? 0;
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
