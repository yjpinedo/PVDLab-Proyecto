<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Mail\ProjectStateUpdate;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        parent::__construct($entity, false);
        $this->model = $this->entity->orderBy('created_at', 'DESC')->with('employee');
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
    public function conceptUpdate(Request $request)
    {
        $project = $this->entity::find($request->input('id'));

        if ( is_null($project) ) return abort(404);

        if ($request->input('concept') == 'RECHAZADO' and $project->concept == 'PENDIENTE') {
            $project->concept = $request->input('concept');
            $project->save();
        }

        return response()->json([
            'message' => __('app.messages.project.' . $project->concept),
        ]);
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
