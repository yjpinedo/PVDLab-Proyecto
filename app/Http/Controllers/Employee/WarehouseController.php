<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\BaseController;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Warehouse $entity
     */
    public function __construct(Warehouse $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.warehouses';

        $this->middleware(function ($request, $next) {
            $employee = Employee::whereId(Auth::user()['model_id'])->first();

            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.employee.warehouses'),
                    'subtitle' => __('app.titles.employee.warehouses'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name',],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);

                //$request->request->add(['employee_id' => $employee->id]);
                $this->model = $this->entity->orderBy('created_at', 'DESC')->with('articles');

                return $next($request);
            }

            return abort(404);
        });
    }
}
