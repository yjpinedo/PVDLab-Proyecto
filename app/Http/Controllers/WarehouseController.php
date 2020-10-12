<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Warehouse;
use Illuminate\Http\JsonResponse;
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
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WarehouseRequest $request
     * @return JsonResponse
     */
    public function store(WarehouseRequest $request)
    {
        $lastId = Warehouse::all()->last()->id;
        $request['code'] = 'ALM - ' . ($lastId + 1);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WarehouseRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(WarehouseRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
