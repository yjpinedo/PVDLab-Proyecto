<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeneficiaryRequest;
use App\Beneficiary;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

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
            'email' => 'required|email|max:50|unique:users,email|unique:beneficiaries,email',
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
        $user = User::where([
            ['model_id', $id],
            ['model_type', 'App\Beneficiary']
        ])->first();
        $user_id = 0;

        if (!is_null($user)){
            $user_id = $user->id;
        }

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('beneficiaries', 'email')->ignore($id),
                Rule::unique('users', 'email')->ignore($user_id),
            ],
        ]);
        return parent::updateBase($request, $id);
    }
}
