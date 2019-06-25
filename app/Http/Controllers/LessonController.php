<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Lesson;
use Illuminate\Http\Response;

class LessonController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Lesson $entity
     */
    public function __construct(Lesson $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('course')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonRequest $request
     * @return Response
     */
    public function store(LessonRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonRequest $request
     * @param int $id
     * @return Response
     */
    public function update(LessonRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }

}
