<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\WarehouseRequest;
use App\Movement;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $input = $request->all();
        $article = null;

        if ($request->validated()) {
            if (!empty($input['warehouse_id']) && !empty($input['stock'])) {
                $input = Arr::except($input, ['warehouse_id']);
                $input = Arr::except($input, ['stock']);
                $article = Article::create($input);
            }

            if ($article) {
                $article->warehouses()->attach($request->input('warehouse_id'), ['stock' => $request->input('stock')]);
                Movement::create([
                    'date' => date('Y-m-d h:i:s'),
                    'stock' => $request->input('stock'),
                    'origin_id' => $request->input('warehouse_id'),
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
        $input = $request->all();
        $article = Article::findOrFail($id);

        if ($request->validated()) {
            $input = Arr::except($input, ['warehouse_id']);
            $input = Arr::except($input, ['stock']);
            $article->update($input);

            if (!empty($input['warehouse_id']) && !empty($input['stock'])) {
                $checked = $article->warehouses()
                                   ->wherePivot('warehouse_id', $request->input('warehouse_id'))
                                   ->wherePivot('article_id', $article->id)
                                   ->first();
                if ($checked !== null) {
                    $article->warehouses()->updateExistingPivot($request->input('warehouse_id'), ['stock' => $request->input('stock')]);
                } else {

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
