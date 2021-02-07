<?php

namespace App\Http\Controllers\Articles;

use App\Article;
use App\Http\Controllers\BaseController;
use App\Warehouse;

class WarehouseController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Warehouse $entity
     */
    public function __construct(Warehouse $entity)
    {
        parent::__construct($entity);

        $this->crud = 'article.warehouses';

        $this->middleware(function ($request, $next) {
            $this->id = $request->article;
            $article = Article::where('id', $request->article)->with('warehouses')->first();

            if ( !is_null($article) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.article'),
                    'subtitle' => __('app.titles.articles_warehouses', ['name' => $article->name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'stock'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);
                $request->request->add(['warehouse_id' => $article->id]);
                $this->model = $article->warehouses->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }
}
