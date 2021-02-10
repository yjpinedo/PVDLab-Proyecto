<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoanController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Loan $entity
     */
    public function __construct(Loan $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.loans';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::whereId(Auth::user()['model_id'])->with('loans.articles')->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.loans'),
                    'subtitle' => __('app.titles.beneficiary.loan.list_loans'),
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'refund', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->loans->sortByDesc('created_at');
                return $next($request);
            }
            return abort(404);
        });
    }
}
