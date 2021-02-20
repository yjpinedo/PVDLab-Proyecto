<?php

namespace App\Http\Controllers\Employee\Warehouses;

use App\Article;
use App\Http\Controllers\BaseController;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $this->crud = 'employee.warehouse.articles';

        $this->middleware(function ($request, $next) {
            $this->id = $request->article;
            $warehouse = Warehouse::whereId($request->warehouse)->with('articles.category')->first();

            if ( !is_null($warehouse) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.employee.warehouses'),
                    'subtitle' => __('app.titles.employee.warehouses_articles', ['name' => $warehouse->name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'serial', 'stock', 'category_id',],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);
                $request->request->add(['warehouse_id' => $warehouse->id]);
                $this->model = $warehouse->articles->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }
}
