<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TeacherController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Teacher $entity
     */
    public function __construct(Teacher $entity)
    {
        parent::__construct($entity, true);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return JsonResponse
     */
    public function store(TeacherRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TeacherRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
