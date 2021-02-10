<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
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
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $lastId = Category::all()->last()->id;
        $request['code'] = 'CAT - ' . ($lastId + 1);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
