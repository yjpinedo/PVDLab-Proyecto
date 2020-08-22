<?php

namespace App\Http\Controllers\Teacher;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakeAssistanceController extends BaseController
{
    private $id;
    private $course;
    private $beneficiary_id;
    private $beneficiary;
    private $message;
    private $error = false;

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
            $this->beneficiary_id = $request->beneficiary_id;
            $this->course = Course::where([['id', $request->course], ['teacher_id', Auth::user()['model_id']]])->with('beneficiaries.lessons')->first();
            $this->beneficiary = $this->entity::where('id', $this->beneficiary_id)->first();

            if ( !is_null($this->course) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.teacher.lessons'),
                    'subtitle' => __('app.titles.teacher.beneficiaries', ['name' => $this->course->full_name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'sex', 'ethnic_group', 'assistance_value',],
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
       if (! $this->beneficiary->lessons->contains($this->id)) {
           $this->beneficiary->lessons()->attach($this->id);
            return response()->json([
                'message' => __('app.messages.task_assistance.assistance', ['name' => $this->entity->find($this->beneficiary_id)->full_name]),
            ]);
        } else {
            return response()->json([
                'message' => __('app.messages.task_assistance.error', ['name' => $this->entity->find($this->beneficiary_id)->full_name]),
                'error' => true,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function destroy()
    {
       if (! $this->beneficiary->lessons->contains($this->id)) {
           $this->beneficiary->lessons()->dettach($this->id);
            return response()->json([
                'message' => __('app.messages.task_assistance.assistance', ['name' => $this->entity->find($this->beneficiary_id)->full_name]),
            ]);
        } else {
            return response()->json([
                'message' => __('app.messages.task_assistance.error', ['name' => $this->entity->find($this->beneficiary_id)->full_name]),
                'error' => true,
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return void
     */
  /*  public function conceptUpdate(Request $request)
    {
        if ( is_null($this->beneficiary) ) return abort(404);

            if ($request->input('assistance') == 'FALLO') {
                if (! $this->beneficiary->lessons->contains($this->id)) {
                    $this->beneficiary->lessons()->attach($this->id);
                    $this->message = __('app.messages.task_assistance.assistance', ['name' => $this->entity->find($this->beneficiary_id)->full_name]);
                    $this->error = true;
                } else {
                    $this->error = false;
                    $this->message = __('app.messages.task_assistance.error', ['name' => $this->entity->find($this->beneficiary_id)->full_name]),
                }
        }
        return response()->json([
            'message' => $this->message,
            'error' =>$this->error
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
   /* public function updateConcept(Request $request)
    {
        //$project = $this->entity::find($request->input('id'));

        if ( is_null($this->beneficiary) ) return abort(404);

        if ($project->concept !== 'RECHAZADO') {

            $project->concept = 'APROBADO';

            $project->save();

            return response()->json([
                'data' => $project,
                'message' => __('app.messages.project.APROBADO'),
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('app.messages.project.update'),
            ]);
        }

    }*/
}
