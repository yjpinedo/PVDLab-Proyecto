<?php

namespace App\Http\Controllers;

use App\FurnitureTransfer;
use App\Http\Requests\FurnitureTransferRequest;
use Illuminate\Http\Response;

class FurnitureTransferController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param FurnitureTransfer $entity
     */
    public function __construct(FurnitureTransfer $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('transfer', 'furniture')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FurnitureTransferRequest $request
     * @return Response
     */
    public function store(FurnitureTransferRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FurnitureTransferRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FurnitureTransferRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
