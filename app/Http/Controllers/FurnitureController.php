<?php

namespace App\Http\Controllers;

use App\Furniture;
use App\Http\Requests\FurnitureRequest;
use Illuminate\Http\Response;

class FurnitureController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Furniture $entity
     */
    public function __construct(Furniture $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('category', 'location')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FurnitureRequest $request
     * @return Response
     */
    public function store(FurnitureRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FurnitureRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FurnitureRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }

}
