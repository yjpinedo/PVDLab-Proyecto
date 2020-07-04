<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementRequest;
use App\Movement;
use Illuminate\Http\Response;

class MovementController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Movement $entity
     */
    public function __construct(Movement $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('warehouse_origin', 'warehouse_destination')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MovementRequest $request
     * @return Response
     */
    public function store(MovementRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovementRequest $request
     * @param int $id
     * @return Response
     */
    public function update(MovementRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
