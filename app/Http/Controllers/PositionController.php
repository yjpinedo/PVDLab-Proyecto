<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PositionController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Position $entity
     */
    public function __construct(Position $entity)
    {
        parent::__construct($entity);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return JsonResponse
     */
    public function store(PositionRequest $request)
    {
        $lastId = Position::all()->last()->id;
        $request['code'] = 'CAR - ' . ($lastId + 1);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PositionRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
