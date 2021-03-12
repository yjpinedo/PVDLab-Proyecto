<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Loan;
use App\Mail\LoanStateUpdate;
use App\Movement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        $this->crud = 'employee.loans';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();
            if (!is_null($employee)) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'employee_id', 'beneficiary_id', 'refund', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);
                // $request->request->add(['employee_id' => $employee->id]);
                $this->model = $this->entity->with('articles', 'beneficiary', 'employee')->orderBy('created_at', 'DESC');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateState(Request $request)
    {
        $error = false;
        $loan = $this->entity::whereId($request->input('id'))->with(['articles.warehouses', 'beneficiary', 'employee'])->first();
        $message = '';

        if (is_null($loan)) return abort(404);

        if ($loan->state !== 'RECHAZADO') {

            if (is_null($loan->employee)) {
                $loan->employee_id = auth()->user()->id;
            }

            if ($loan->employee->id != auth()->user()->id) {
                $loan->employee_id = auth()->user()->id;
            }

            if ($request->input('state') === 'RECHAZADO') {
                $message = 'RECHAZADO';
                $error = true;
            }

            if ($request->input('state') === 'APROBADO') {
                $message = 'APROBADO';
                foreach ($loan->articles as $article) {
                    $quantity = $article->pivot->quantity;
                    foreach ($article->warehouses as $key => $warehouses) {
                        $quantityStock = $quantity - $warehouses->pivot->stock;
                        if ($quantityStock <= 0) {
                            $quantityStock = ($quantityStock * (-1));
                            $warehouses->articles()->updateExistingPivot($article->id, ['stock' => $quantityStock]);
                            Movement::create([
                                'type' => 'SALIDA',
                                'stock' => $quantity,
                                'origin_id' => $warehouses->id,
                            ]);
                            break;
                        } else {
                            $warehouses->articles()->updateExistingPivot($article->id, ['stock' => '0']);
                            Movement::create([
                                'type' => 'SALIDA',
                                'stock' => $quantity,
                                'origin_id' => $warehouses->id,
                            ]);
                            $quantity = $quantityStock;
                        }
                    }
                }
            }

            $loan->state = $request->input('state');
            $loan->save();

            $body = [
                'loan' => $loan,
                'url' => $request->root() . "/beneficiary/loans",
            ];

            Mail::to($loan->beneficiary->email)->send(new LoanStateUpdate($body));

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
