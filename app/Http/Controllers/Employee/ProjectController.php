<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProjectRequest;
use App\Mail\ProjectStateUpdate;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProjectController extends BaseController
{

    /**
     * Create a controller instance.
     *
     * @param Project $entity
     */
    public function __construct(Project $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.projects';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();
            $this->model = $this->entity->orderBy('created_at', 'DESC');
            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'start', 'concept'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [/*
                        [
                            'type' => 'section',
                            'value' => 'app.sections.project_information',
                        ],
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'start',
                            'type' => 'date',
                        ],
                        [
                            'name' => 'type',
                            'type' => 'select',
                            'value' => 'app.selects.project.type',
                        ],
                        [
                            'name' => 'other_type',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'description',
                            'type' => 'textarea',
                        ],
                        [
                            'name' => 'origin',
                            'type' => 'select',
                            'value' => 'app.selects.project.origin',
                        ],
                        [
                            'name' => 'other_origin',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'state',
                            'type' => 'select',
                            'value' => 'app.selects.project.state',
                        ],
                        [
                            'name' => 'beneficiary_id',
                            'type' => 'select_reload',
                        ],
                        [
                            'name' => 'reviewed_at',
                            'type' => 'date',
                        ],
                        [
                            'type' => 'section',
                            'value' => 'app.sections.financing_information',
                        ],
                        [
                            'name' => 'financing',
                            'type' => 'select',
                            'value' => 'app.selects.project.financing',
                        ],
                        [
                            'name' => 'financial_entity',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'financing_description',
                            'type' => 'textarea',
                        ],
                    */],
                ]]);
                $request->request->add(['employee_id' => $employee->id]);
                //$this->model = $employee->projects->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */
    public function store(ProjectRequest $request)
    {
        $request->validate([
            'start' => 'required|date',
        ]);
        $lastId = Project::all()->last()->id;
        $request['code'] = 'PRO - ' . ($lastId + 1);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProjectRequest $request, int $id)
    {
        $request->validate([
            'start' => 'required|date',
        ]);
        return parent::updateBase($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateConcept(Request $request)
    {
        $project = $this->entity::whereId($request->input('id'))->with('beneficiary')->first();
        $message = '';

        if ( is_null($project) ) return abort(404);

        if ($project->concept !== 'RECHAZADO') {

            if ($request->input('concept') === 'RECHAZADO') {
                $message = 'RECHAZADO';
                $error = true;
            }

            if ($request->input('concept') === 'APROBADO') {
                $message = 'APROBADO';
                $error = false;
            }

            $project->concept = $request->input('concept');
            $project->save();

            $body = [
                'project' => $project,
                'url' => $request->root() . "/beneficiary/projects",
            ];

            Mail::to($project->beneficiary->email)->send(new ProjectStateUpdate($body));

            return response()->json([
                'data' => $project,
                'message' => __("app.messages.project.$message"),
                'error' => $error
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('app.messages.project.update'),
            ]);
        }
    }
}
