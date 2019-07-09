<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        $this->crud = 'beneficiary.projects';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::where('id', Auth::user()['model_id'])->first();
            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'start', 'type', 'concept'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [
                        [
                            'type' => 'section',
                            'value' => 'app.sections.project_information',
                        ],
                        [
                            'name' => 'code',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'date',
                            'type' => 'date',
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
                $this->model = $beneficiary->projects->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }
}
