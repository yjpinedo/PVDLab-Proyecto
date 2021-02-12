<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApplicationCourseController extends BaseController
{
    private $id;
    private $beneficiary;

    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.courses_application';

        $this->middleware(function ($request, $next) {
            $this->id = $request->course;
            $this->model = $this->entity->where([
                ['id', $this->id],
                ['state', __('app.selects.course.state.DISPONIBLE')],
            ]);
            if (!is_null($this->model->first())) {
                $this->beneficiary = Beneficiary::where('id', Auth::user()['model_id'])->first();

                if (!is_null($this->beneficiary)) {
                    $request->request->add(['data' => [
                        'title' => __('app.titles.beneficiary.application_course'),
                        'subtitle' => __('app.titles.courses'),
                        'tools' => [
                            'create' => false,
                            'reload' => false,
                            'export' => false,
                        ],
                        'table' => [],
                        'form' => [
                            [
                                'name' => 'code',
                                'type' => 'text',
                            ],
                            [
                                'name' => 'name',
                                'type' => 'text',
                            ],
                            [
                                'name' => 'description',
                                'type' => 'textarea',
                            ],
                        ],
                    ]]);

                    return $next($request);
                }
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
        $location = route('beneficiary.courses.index');

        if (! $this->beneficiary->courses->contains($this->id)) {
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
        }
    }
}
