<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends BaseController
{

    /**
     * Create a controller instance.
     *
     * @param Transfer $entity
     */
    public function __construct(Transfer $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.transfers';

        $this->middleware(function ($request, $next) {
            $employee = Employee::where('id', Auth::user()['model_id'])->with('transfer.beneficiary')->first();
            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'origin_id', 'destination_id', 'beneficiary_id', ],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [
                        [
                            'name' => 'date',
                            'type' => 'date',
                        ],
                        [
                            'name' => 'type',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'origin_id',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'destination_id',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'beneficiary_id',
                            'type' => 'select_reload',
                        ],
                        [
                            'name' => 'employee_id',
                            'type' => 'select_reload',
                        ],
                        [
                            'name' => 'project_id',
                            'type' => 'select_reload',
                        ],
                    ],
                ]]);
                $request->request->add(['beneficiary_id' => $employee->id]);
                $this->model = $employee->transfer->sortByDesc('date');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function statusUpdate(Request $request)
    {
        $turn = $this->entity::find($request->input('id'));

        if ( is_null($turn) ) return abort(404);

        if ($request->input('state') == __('app.selects.turns.state_next.' . $turn->state)) {
            $turn->state = $request->input('state');
            $turn->save();
        }

        return response()->json([
            'message' => __('app.messages.turns.' . $turn->state),
        ]);
    }
}
