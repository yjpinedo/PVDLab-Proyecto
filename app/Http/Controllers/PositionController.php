<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Position;
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PositionRequest $request
     * @return Response
     */
    public function store(PositionRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PositionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PositionRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
