<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;
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
        parent::__construct($entity, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return Response
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
     * @return Response
     */
    public function update(TeacherRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
