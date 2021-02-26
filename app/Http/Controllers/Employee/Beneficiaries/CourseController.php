<?php

namespace App\Http\Controllers\Employee\Beneficiaries;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);

        $this->crud = 'employee.beneficiaries.courses';

        $this->middleware(function ($request, $next) {
            $this->id = $request->course;
            $beneficiary = Beneficiary::where('id', $request->beneficiary)->with('courses.teacher')->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.beneficiaries'),
                    'subtitle' => __('app.titles.beneficiary.courses_admin', ['name' => $beneficiary->full_name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'teacher', 'progress'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);
                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->courses->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }
}
