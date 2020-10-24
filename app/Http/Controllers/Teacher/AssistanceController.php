<?php

namespace App\Http\Controllers\Teacher;

use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Lesson;
use Illuminate\Http\Request;

class AssistanceController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Beneficiary $entity
     */
    public function __construct(Beneficiary $entity)
    {
        parent::__construct($entity);

        $this->crud = 'teacher.assistance';

        $this->middleware(function ($request, $next) {
            $this->id = $request->beneficiary;
            $lesson = Lesson::where('id', $request->lesson)->with('beneficiaries.lessons')->first();

            if ( !is_null($lesson) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.teacher.lessons'),
                    'subtitle' => __('app.titles.teacher.beneficiaries'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'sex', 'ethnic_group'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['lesson_id' => $lesson->id]);
                $this->model = $lesson->beneficiaries->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }
}
