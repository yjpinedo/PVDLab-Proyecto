<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Category $entity
     */
    public function __construct(Category $entity)
    {
        parent::__construct($entity, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CategoryRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
