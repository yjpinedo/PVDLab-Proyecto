<?php

namespace App\Http\Controllers\Beneficiaries;

use App\Course;
use App\Http\Controllers\BaseController;
use App\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        $this->middleware(function ($request, $next) {
            $this->id = $request->lesson;
            $course = Course::where([['id', $request->course]])->with('lessons.course')->first();

            if ( !is_null($course) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.courses_lessons'),
                    'subtitle' => __('app.titles.beneficiary.lessons', ['name' => $course->full_name]),
                    'form' => [],
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

}
