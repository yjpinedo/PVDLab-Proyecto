<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MemberController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Member $entity
     */
    public function __construct(Member $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('project')->orderBy('created_at', 'DESC');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MemberRequest $request
     * @return JsonResponse
     */
    public function store(MemberRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MemberRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
