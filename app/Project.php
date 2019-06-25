<?php

namespace App;

class Project extends Base
{
    /**
     * The data to build the layout.
     *
     * @var array
     */
    protected $layout = [
        'tools' => [
            'create' => true,
            'reload' => false,
        ],
        'table' => [
            'check' => false,
            'fields' => ['code', 'name', 'start', 'type', 'concept'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'type' => 'section',
                'value' => 'app.sections.project_information',
            ],
            [
                'name' => 'code',
                'type' => 'text',
            ],
            [
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'date',
                'type' => 'date',
            ],
            [
                'name' => 'start',
                'type' => 'date',
            ],
            [
                'name' => 'type',
                'type' => 'select',
                'value' => 'app.selects.project.type',
            ],
            [
                'name' => 'other_type',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
            ],
            [
                'name' => 'origin',
                'type' => 'select',
                'value' => 'app.selects.project.origin',
            ],
            [
                'name' => 'other_origin',
                'type' => 'text',
            ],
            [
                'name' => 'state',
                'type' => 'select',
                'value' => 'app.selects.project.state',
            ],
            [
                'type' => 'section',
                'value' => 'app.sections.financing_information',
            ],
            [
                'name' => 'financing',
                'type' => 'select',
                'value' => 'app.selects.project.financing',
            ],
            [
                'name' => 'financial_entity',
                'type' => 'text',
            ],
            [
                'name' => 'financing_description',
                'type' => 'textarea',
            ],
            [
                'name' => 'concept',
                'type' => 'select',
                'value' => 'app.selects.project.concept',
            ],
        ],
    ];

    // Relationships

    /**
     * BeneficiaryProject relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectBeneficiary()
    {
        return $this->hasMany(BeneficiaryProject::class);
    }

    /**
     * Transfer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }


}
