<?php

namespace App\Http\Controllers\Employee\Beneficiaries;

use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Mail\ProjectStateUpdate;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $this->crud = 'employee.beneficiaries.projects';

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
                    'form' => [],
                ]]);
                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->projects->sortByDesc('start');

                return $next($request);
            }

            return abort(404);
        });
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

        if (is_null($project)) return abort(404);

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
