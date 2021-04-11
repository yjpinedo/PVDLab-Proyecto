<?php

namespace App\Http\Controllers\Employee;

use App\Beneficiary;
use App\Employee;
use App\Http\Controllers\BaseController;
use App\Http\Requests\BeneficiaryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends BaseController
{

    /**
     * Create a controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.beneficiaries';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();
            $this->model = $this->entity->orderBy('created_at', 'DESC');
            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['document', 'name', 'sex', 'ethnic_group'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [/*
                        [
                            'type' => 'section',
                            'value' => 'app.sections.personal_information',
                        ],
                        [
                            'name' => 'document_type',
                            'type' => 'select',
                            'value' => 'app.selects.person.document_type',
                        ],
                        [
                            'name' => 'document',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'expedition_place',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'last_name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'sex',
                            'type' => 'select',
                            'value' => 'app.selects.person.sex',
                        ],
                        [
                            'name' => 'birth_date',
                            'type' => 'date',
                        ],
                        [
                            'name' => 'place_of_birth',
                            'type' => 'text',
                        ],
                        [
                            'type' => 'section',
                            'value' => 'app.sections.contact_information',
                        ],
                        [
                            'name' => 'address',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'neighborhood',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'phone',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'cellphone',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'email',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'occupation',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'ethnic_group',
                            'type' => 'select',
                            'value' => 'app.selects.person.ethnic_group',
                        ],
                        [
                            'name' => 'other_ethnic_group',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'stratum',
                            'type' => 'select',
                            'value' => 'app.selects.person.stratum',
                        ],
                    */],
                ]]);
                //$request->request->add(['employee_id' => $employee->id]);
                //$this->model = $employee->beneficiary->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
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
