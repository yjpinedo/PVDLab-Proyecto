<?php

namespace App\Http\Controllers\Beneficiary;

use App\Beneficiary;
use App\Lesson;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;

class LessonController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Lesson $entity
     */
    public function __construct(Lesson $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.lessons';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::where('id', Auth::user()['model_id'])->with('lessons.course')->first();

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
                $this->model = $beneficiary->lessons->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }

}
