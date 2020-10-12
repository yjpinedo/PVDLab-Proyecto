<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CourseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);
        $this->model = $this->entity->with('teacher')->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest $request
     * @return JsonResponse
     */
    public function store(CourseRequest $request)
    {
        $lastId = Course::all()->last()->id;
        $request['code'] = 'CUR - ' . ($lastId + 1);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CourseRequest $request, int $id)
    {
        return
            parent::updateBase($request, $id);
    }
}
