<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryRequest;
use App\Beneficiary;
use Illuminate\Http\Response;

class BeneficiaryController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        parent::__construct($entity, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @return Response
     */
    public function store(BeneficiaryRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BeneficiaryRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
