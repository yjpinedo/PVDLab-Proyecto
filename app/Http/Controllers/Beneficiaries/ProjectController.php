<?php

namespace App\Http\Controllers\Beneficiaries;

use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends BaseController
{

    private $id;

    /**
     * Create a controller instance.
     *
     * @param Project $entity
     */
    public function __construct(Project $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiaries.projects';

        $this->middleware(function ($request, $next) {
            $this->id = $request->project;
            $beneficiary = Beneficiary::where('id', $request->beneficiary)->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.beneficiaries'),
                    'subtitle' => __('app.titles.beneficiary.projects', ['name' => $beneficiary->full_name]),
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'start', 'concept'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [
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
                            'name' => 'concept',
                            'type' => 'select',
                            'value' => 'app.selects.project.concept',
                        ],
                        [
                            'name' => 'employee_id',
                            'type' => 'select_reload',
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
                    ],
                ]]);
                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->projects->sortByDesc('start');

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

        return parent::storeBase($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */
    public function update(ProjectRequest $request)
    {
        $request->validate([
            'start' => 'required|date',
        ]);
        return parent::updateBase($request,$this->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateConcept(Request $request)
    {
        $project = $this->entity::find($request->input('id'));

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
