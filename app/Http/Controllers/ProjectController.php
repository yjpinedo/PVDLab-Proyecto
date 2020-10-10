<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $this->model = $this->entity->with('employee')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return Response
     */
    public function store(ProjectRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ProjectRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
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
     * @return Response
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
