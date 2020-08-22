<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\WarehouseRequest;
use App\Movement;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class ArticleController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Article $entity
     */
    public function __construct(Article $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('category', 'warehouses')->orderBy('created_at');
    }

    public function create(){
        $warehouses = Warehouse::orderBy('created_at', 'DESC')->get();
        return view('articles.create', compact('warehouses'));
    }

    public function edit($id){
        $article =  Article::findOrFail($id)->load([
            'category' => function ($q) {
                $q->select('id', 'name');
            }
        ]);
        $warehouses = Warehouse::orderBy('created_at', 'DESC')->get();
        $articleWarehouses = $article->warehouses;
        return view('articles.edit', [
            'article'    => $article,
            'warehouses' => $warehouses,
            'articleWarehouses' => $articleWarehouses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $input = $request->except(['warehouse_id', 'stock']);
        $article = Article::create($input);
        foreach ($request->input('warehouse_id') as $key=>$warehouse) {
            if ($request->input('stock')[$key] != '0') {
                $article->warehouses()->attach($warehouse, ['stock' => $request->input('stock')[$key]]);
                Movement::create([
                    'date' => date('Y-m-d h:i:s'),
                    'stock' => $request->input('stock')[$key],
                    'origin_id' => $warehouse,
                ]);
            }
        }
        return response()->json([
            'data' => $article,
            'message' => __('base.messages.store', ['name' => $article->name]),
            'reload' => false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ArticleRequest $request, int $id)
    {
        $input = $request->except(['warehouse_id', 'stock']);
        $article = Article::find($id)->fill($input);

        if ($request->validated()) {
            $article->update($input);

            foreach ($request->input('warehouse_id') as $key=>$warehouse) {
                if ($request->input('stock')[$key] != '0') {
                    $checked = $article->warehouses()
                        ->wherePivot('warehouse_id', $warehouse)
                        ->wherePivot('article_id', $article->id)
                        ->first();
                    if ($checked !== null) {
                        $article->warehouses()->updateExistingPivot($warehouse, ['stock' => $request->input('stock')[$key]]);
                    }
                }
            }
        }
        return response()->json([
            'data' => $article,
            'message' => __('base.messages.update', ['name' => $article->name]),
            'reload' => false,
        ]);
    }

}
