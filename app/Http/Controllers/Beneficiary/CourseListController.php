<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class CourseListController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.courses_lists';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::where('id', Auth::user()['model_id'])->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.courses'),
                    'subtitle' => __('app.titles.courses'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'description', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                //$this->model = $beneficiary->courses->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }
}
