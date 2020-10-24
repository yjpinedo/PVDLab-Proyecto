<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Course;
use App\Lesson;
use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
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
                    'title' => __('app.titles.beneficiary.courses'),
                    'subtitle' => __('app.titles.beneficiary.lessons', ['name' => $course->full_name]),
                    'tools' => [
                        'export' => false,
                        'to_return' => true,
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
