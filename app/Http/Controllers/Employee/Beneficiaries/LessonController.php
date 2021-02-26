<?php

namespace App\Http\Controllers\Employee\Beneficiaries;

use App\Course;
use App\Http\Controllers\BaseController;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Lesson $entity
     */
    public function __construct(Lesson $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.course.lessons';

        $this->middleware(function ($request, $next) {
            $this->id = $request->lesson;
            $course = Course::whereId([$request->course])->with('lessons.course')->first();

            if (!is_null($course)) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.courses_lessons'),
                    'subtitle' => __('app.titles.beneficiary.lessons', ['name' => $course->full_name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id','date', 'course_id'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['course_id' => $course->id]);
                $this->model = $course->lessons->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }
}
