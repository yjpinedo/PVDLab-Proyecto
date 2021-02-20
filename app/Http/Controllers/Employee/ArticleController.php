<?php

namespace App\Http\Controllers\Employee;

use App\Article;
use App\Employee;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Article $entity
     */
    public function __construct(Article $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.articles';

        $this->middleware(function ($request, $next) {
            $this->id = $request->article;
            $employee = Employee::whereId(Auth::user()['model_id'])->first();

            if ( !is_null($employee) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.employee.articles'),
                    'subtitle' => __('app.titles.employee.articles'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'serial', 'category_id',],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);
                //$request->request->add(['warehouse_id' => $employee->id]);
                $this->model = $this->entity->orderBy('created_at', 'DESC')->with('category', 'warehouses');

                return $next($request);
            }

            return abort(404);
        });
    }
}
