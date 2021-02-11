<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
            'export' => true,
        ],
        'table' => [
            'check' => false,
            'fields' => ['code', 'name', 'start', 'concept'],
            'active' => false,
            'actions' => true,
        ],
        'form' => [
            [
                'type' => 'section',
                'value' => 'app.sections.project_information',
            ],
            [
                'name' => 'name',
                'type' => 'text',
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
                'name' => 'concept',
                'type' => 'select',
                'value' => 'app.selects.project.concept',
            ],
            [
                'name' => 'beneficiary_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'employee_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'reviewed_at',
                'type' => 'date',
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
            'approved' => $this->concept == 'APROBADO',
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

    /**
     * Mutator for the full name
     *
     * @param $value
     * @return string
     */
    public function getStartAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Relationships

    /**
     * The beneficiaries that belong to the project.
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    /**
     * Employee relationship
     *
     * @return BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Employee relationship
     *
     * @return HasMany
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
