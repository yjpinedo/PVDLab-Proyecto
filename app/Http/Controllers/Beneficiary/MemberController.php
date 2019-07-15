<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\BaseController;
use App\Http\Requests\MemberRequest;
use App\Member;
use App\Project;

class MemberController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Member $entity
     */
    public function __construct(Member $entity)
    {
        parent::__construct($entity);

        $this->middleware(function ($request, $next) {
            $this->id = $request->member;
            $project = Project::where([['id', $request->project]])->with('members.project')->first();

            if ( !is_null($project) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.beneficiary.projects'),
                   // 'subtitle' => __('app.titles.beneficiary.member', ['name' => $project->full_name]),
                    'form' => [
                        [
                            'type' => 'section',
                            'value' => 'app.sections.personal_information',
                        ],
                        [
                            'name' => 'document_type',
                            'type' => 'select',
                            'value' => 'app.selects.person.document_type',
                        ],
                        [
                            'name' => 'document',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'last_name',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'sex',
                            'type' => 'select',
                            'value' => 'app.selects.person.sex',
                        ],
                        [
                            'name' => 'birth_date',
                            'type' => 'date',
                        ],
                        [
                            'name' => 'place_of_birth',
                            'type' => 'text',
                        ],
                        [
                            'type' => 'section',
                            'value' => 'app.sections.contact_information',
                        ],
                        [
                            'name' => 'address',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'neighborhood',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'phone',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'cellphone',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'email',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'occupation',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'ethnic_group',
                            'type' => 'select',
                            'value' => 'app.selects.person.ethnic_group',
                        ],
                        [
                            'name' => 'other_ethnic_group',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'stratum',
                            'type' => 'select',
                            'value' => 'app.selects.person.stratum',
                        ],
                    ],
                ]]);

                $request->request->add(['project_id' => $project->id]);
                $this->model = $project->members->sortByDesc('name');

                return $next($request);
            }

            return abort(404);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return parent::show($this->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        return parent::storeBase($request, false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MemberRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, int $id)
    {
        return parent::updateBase($request, $id);
    }
}
