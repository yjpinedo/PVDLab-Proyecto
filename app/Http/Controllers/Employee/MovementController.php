<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Movement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MovementController extends BaseController
{

    /**
     * Create a controller instance.
     *
     * @param Movement $entity
     */
    public function __construct(Movement $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.movements';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();
            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'type', 'origin_id', 'destination_id'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [
                        /*[
                            'name' => 'type',
                            'type' => 'select',
                            'value' => 'app.selects.movement.type',
                        ],
                        [
                            'name' => 'stock',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'origin_id',
                            'type' => 'select_reload',
                        ],
                        [
                            'name' => 'destination_id',
                            'type' => 'select_reload',
                        ],*/
                    ],
                ]]);
                $request->request->add(['employee_id' => $employee->id]);
                $this->model = $this->entity->with('warehouse_origin', 'warehouse_destination')->orderBy('created_at', 'DESC');

                return $next($request);
            }

            return abort(404);
        });
    }
}
