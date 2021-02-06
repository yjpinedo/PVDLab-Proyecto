<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoanController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Loan $entity
     */
    public function __construct(Loan $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('articles', 'beneficiary', 'employee')->orderBy('created_at', 'DESC');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateState(Request $request)
    {
        $loan = $this->entity::find($request->input('id'));

        if ( is_null($loan) ) return abort(404);

        if ($loan->state !== 'RECHAZADO') {

            if ($request->input('state') === 'RECHAZADO') {
                $message = 'RECHAZADO';
                $error = true;
            }

            if ($request->input('state') === 'APROBADO') {
                $message = 'APROBADO';
                $error = false;
            }

            $loan->state = $request->input('state');
            $loan->save();

            return response()->json([
                'data' => $loan,
                'message' => __("app.messages.loan.$message"),
                'error' => $error
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('app.messages.loan.update'),
            ]);
        }
    }
}
