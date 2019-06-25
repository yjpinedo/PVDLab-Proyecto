<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Transfer;
use Illuminate\Http\Response;

class TransferController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Transfer $entity
     */
    public function __construct(Transfer $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('beneficiary', 'employee', 'project')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransferRequest $request
     * @return Response
     */
    public function store(TransferRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransferRequest $request
     * @param int $id
     * @return Response
     */
    public function update(TransferRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
