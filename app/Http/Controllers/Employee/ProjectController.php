<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Project;
use Illuminate\Http\Request;
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

        $this->crud = 'employee.projects';

        $this->middleware(function ($request, $next) {
            $employee = Employee::where('id', Auth::user()['model_id'])->first();
            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => true,
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
                        [
                            'name' => 'concept',
                            'type' => 'select',
                            'value' => 'app.selects.project.concept',
                        ],
                        [
                            'name' => 'employee_id',
                            'type' => 'select_reload',
                        ],
                    ],
                ]]);
                $request->request->add(['beneficiary_id' => $employee->id]);
                $this->model = $employee->projects->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function statusUpdate(Request $request)
    {
        $turn = $this->entity::find($request->input('id'));

        if ( is_null($turn) ) return abort(404);

        if ($request->input('state') == __('app.selects.turns.state_next.' . $turn->state)) {
            $turn->state = $request->input('state');
            $turn->save();
        }

        return response()->json([
            'message' => __('app.messages.turns.' . $turn->state),
        ]);
    }
}
