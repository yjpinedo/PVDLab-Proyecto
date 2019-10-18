<?php

namespace App\Http\Controllers\Teacher;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TakeAssistanceController extends BaseController
{
    private $id;
    private $course;
    //private $beneficiary;

    /**
     * Create a controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        parent::__construct($entity);

        $this->crud = 'teacher.take_assistance';

        $this->middleware(function ($request, $next) {
            $this->id = $request->lesson;
            $this->course = Course::where([['id', $request->course], ['teacher_id', Auth::user()['model_id']]])->with('beneficiaries.lessons')->first();

            if ( !is_null($this->course) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.teacher.lessons'),
                    'subtitle' => __('app.titles.teacher.beneficiaries', ['name' => $this->course->full_name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'sex', 'ethnic_group'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['course_id' => $this->course->id]);
                $this->model = $this->course->beneficiaries->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store()
    {
        //$location = route('course_assistance.index');

        /*$this->entity->lessons()->attach($this->id);

        return response()->json([
            'message' => __('app.messages.task_assistance.assistance', ['name' => $this->entity->find($this->id)->full_name]),
            //'location' => $location
        ]);*/

        dd($this->course->beneficiaries);

       /* if (! $this->beneficiary->courses->contains($this->id)) {
            $this->beneficiary->courses()->attach($this->id);

            return response()->json([
                'message' => __('app.messages.apply.apply', ['name' => $this->entity->find($this->id)->full_name]),
                'location' => $location
            ]);
        } else {
            return response()->json([
                'message' => __('app.messages.apply.error', ['name' => $this->entity->find($this->id)->full_name]),
                'error' => true,
                'location' => $location
            ]);
        }*/
    }
}
