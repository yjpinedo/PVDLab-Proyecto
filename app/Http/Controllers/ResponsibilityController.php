<?php

namespace App\Http\Controllers;

use App\responsibility;
use Illuminate\Http\Request;

/**
 * @property  entity
 */
class ResponsibilityController extends Controller
{

    /**
     * Create a controller instance.
     *
     * @param responsibility $entity
     */
    public function __construct(Responsibility $entity)
    {
        //parent::__construct($entity, false);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param responsibility $entity
     * @return void
     */
    public function index(Responsibility $entity)
    {
        return view('app.index')->with(array_merge(array_merge([
            'crud' => 'responsibility',
            'title' => __('app.titles.' .'responsibility'),
            //'subtitle' => __('app.titles.' . $this->crud),
        ], $entity->getLayout())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return Response
     */
    public function update( $request, int $id)
    {
        //return parent::updateBase($request, $id);
    }
}
