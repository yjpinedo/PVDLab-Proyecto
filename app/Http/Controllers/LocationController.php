<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LocationController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Location $entity
     */
    public function __construct(Location $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LocationRequest $request
     * @return JsonResponse
     */
    public function store(LocationRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LocationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LocationRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
