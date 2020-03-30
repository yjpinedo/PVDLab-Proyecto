<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Warehouse;
use Illuminate\Http\Response;

class WarehouseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Warehouse $entity
     */
    public function __construct(Warehouse $entity)
    {
        parent::__construct($entity, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WarehouseRequest $request
     * @return Response
     */
    public function store(WarehouseRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WarehouseRequest $request
     * @param int $id
     * @return Response
     */
    public function update(WarehouseRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
