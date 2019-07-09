<?php

namespace App;

/**
 * @property mixed concept
 * @property mixed id
 */
class Project extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'actions', 'full_name', 'translated_concept',
    ];

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
            'fields' => ['code', 'name', 'start', 'employee_id', 'concept'],
            'active' => false,
            'actions' => true,
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
            [
                'name' => 'employee_id',
                'type' => 'select_reload',
            ],
        ],
    ];

    // Mutator

    /**
     * Mutator for the actions
     *
     * @return array
     */
    public function getActionsAttribute()
    {
        return [
            'id' => $this->id,
            'cancel' => $this->concept == 'PENDIENTE',
            'next' => __('app.selects.project.concept_next.' . $this->concept),
        ];
    }

    /**
     * Mutator for the actions
     *
     * @return array
     */
    public function getTranslatedConceptAttribute()
    {
        return [
            'concept' => $this->concept,
            'class' => __('app.selects.project.concept_class.' . $this->concept),
        ];
    }

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    // Relationships

    /**
     * The beneficiaries that belong to the project.
     */
    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class);
    }

    /**
     * Position relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
