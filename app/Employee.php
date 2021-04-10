<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Base
{
    use SoftDeletes;
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
            'fields' => ['document', 'name', 'sex', 'position_id'],
            'active' => false,
            'actions' => false,
        ],
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
                'name' => 'expedition_place',
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
                'name' => 'position_id',
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
        return $this->name . ' ' . $this->last_name;
    }


    /**
     * Mutator for the value to show in the select
     *
     * @return string
     */
    public function getSelectValueAttribute()
    {
        return $this->full_name;
    }

    // Relationships

    /**
     * Position relationship
     *
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Transfer relationship
     *
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return HasMany
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
