<?php

namespace App\Http\Controllers\Teacher;

use App\Beneficiary;
use App\Course;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeneficiaryController extends BaseController
{
    //private $id;

    /**
     * Create a controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        parent::__construct($entity);

        $this->crud = 'teacher.beneficiaries';

        $this->middleware(function ($request, $next) {
        //    $this->id = $request->beneficiary;
            $course = Course::where([['id', $request->course], ['teacher_id', Auth::user()['model_id']]])->with('beneficiaries.lessons')->first();

            if ( !is_null($course) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.teacher.courses'),
                    'subtitle' => __('app.titles.teacher.beneficiaries', ['name' => $course->full_name]),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'sex', 'ethnic_group'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['course_id' => $course->id]);
                $this->model = $course->beneficiaries->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }
}
