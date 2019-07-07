<?php

namespace App;

class Transfer extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'name',
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
            'fields' => ['id', 'origin_id', 'destination_id', 'beneficiary_id', 'employee_id', 'project_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'date',
                'type' => 'date',
            ],
            [
                'name' => 'type',
                'type' => 'text',
            ],
            [
                'name' => 'origin_id',
                'type' => 'text',
            ],
            [
                'name' => 'destination_id',
                'type' => 'text',
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
                'name' => 'project_id',
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
        return $this->type;
    }

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->type;
    }

    // Relationships

    /**
     * beneficiary relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    /**
     * beneficiary relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * The furniture that belong to the transfer.
     */
    public function furniture()
    {
        return $this->belongsToMany(Furniture::class);
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
