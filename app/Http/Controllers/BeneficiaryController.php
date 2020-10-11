<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryRequest;
use App\Beneficiary;
use Illuminate\Http\JsonResponse;
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
        parent::__construct($entity, true);
        $this->model = $this->entity->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @return JsonResponse
     */
    public function store(BeneficiaryRequest $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|unique:beneficiaries,email',
        ]);
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BeneficiaryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BeneficiaryRequest $request, int $id)
    {
        $request->validate([
            'email' => 'required|email|unique:beneficiaries,email,' . $id,
        ]);
        return parent::updateBase($request, $id);
    }
}
