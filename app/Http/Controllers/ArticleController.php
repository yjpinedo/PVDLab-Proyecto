<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\WarehouseRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $this->model = $this->entity->with('category', 'warehouse')->orderBy('created_at');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        return parent::storeBase($request, false);
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
        return parent::updateBase($request, $id);
    }

}
