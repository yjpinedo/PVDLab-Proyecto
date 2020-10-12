<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Movement;
use App\Warehouse;
use Illuminate\Http\JsonResponse;

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
        $this->model = $this->entity->with('category', 'warehouses')->orderBy('created_at', 'DESC');
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
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $warehouses = Warehouse::orderBy('created_at', 'DESC')->get();
        $articleWarehouses = [];

        foreach ($article->warehouses as $warehouse) {
            $articleWarehouses[$warehouse->id] = $warehouse->pivot->stock;
        }

        return view('articles.edit', [
            'categories'        => $categories,
            'article'           => $article,
            'warehouses'        => $warehouses,
            'articleWarehouses' => $articleWarehouses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $request->validate([
            'serial' => 'required|numeric|digits_between:6,12|unique:articles',
        ]);
        $input = $request->except(['warehouse_id', 'stock']);
        $lastId = Article::all()->last()->id;
        $input['code'] = 'ART - ' . ($lastId + 1);
        $article = Article::create($input);
        foreach ($request->input('warehouse_id') as $key=>$warehouse) {
            if ($request->input('stock')[$key] != '0') {
                $article->warehouses()->attach($warehouse, ['stock' => $request->input('stock')[$key]]);
                Movement::create([
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
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, int $id)
    {
        $request->validate([
            'serial' => 'required|numeric|digits_between:6,12|unique:articles,serial,' . $id,
        ]);
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
                    if ($checked != null) {
                        $article->warehouses()->updateExistingPivot($warehouse, ['stock' => $request->input('stock')[$key]]);
                    } else {
                        $article->warehouses()->attach($warehouse, ['stock' => $request->input('stock')[$key]]);
                    }
                    Movement::create([
                        'stock' => $request->input('stock')[$key],
                        'origin_id' => $warehouse,
                    ]);
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
