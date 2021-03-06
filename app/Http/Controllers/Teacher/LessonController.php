<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Http\Controllers\BaseController;
use App\Http\Requests\LessonRequest;
use App\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        $this->crud = 'teacher.lessons';

        $this->middleware(function ($request, $next) {
            $this->id = $request->lesson;
            $course = Course::where([['id', $request->course], ['teacher_id', Auth::user()['model_id']]])->with('lessons.course')->first();

            if ( !is_null($course) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.teacher.courses'),
                    'subtitle' => __('app.titles.teacher.lessons', ['name' => $course->full_name]),
                    'table' => [
                        'check' => false,
                        'fields' => ['id','date', 'course_id'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [
                        [
                            'name' => 'date',
                            'type' => 'date',
                        ],
                    ],
                ]]);

                $request->request->add(['course_id' => $course->id]);
                $this->model = $course->lessons->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return parent::show($this->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest $request
     * @return JsonResponse
     */
    public function store(LessonRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LessonRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
