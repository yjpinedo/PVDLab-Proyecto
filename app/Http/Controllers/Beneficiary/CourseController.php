<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class CourseController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.courses';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::where('id', Auth::user()['model_id'])->with('courses.teacher')->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => false,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->courses->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }
}
