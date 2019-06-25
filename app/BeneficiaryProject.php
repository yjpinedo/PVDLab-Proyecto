<?php

namespace App;

/**
 * @property mixed beneficiary
 * @property mixed project
 */
class BeneficiaryProject extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name',
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
            'fields' => ['id',  'project_id', 'beneficiary_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'project_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'beneficiary_id',
                'type' => 'select_reload',
            ],
        ],
    ];

    // Mutator

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return  $this->project->name . ' - ' . $this->beneficiary->name . ' ' . $this->beneficiary->last_name;
    }

    // Relationships

    /**
     * Beneficiary relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    /**
     * Project relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
