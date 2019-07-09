<?php

namespace App;

class Course extends Base
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
            'export' => true,
            'reload' => false,
        ],
        'table' => [
            'check' => false,
            'fields' => ['code', 'name', 'teacher'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'teacher_id',
                'type' => 'select_reload',
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
                'name' => 'description',
                'type' => 'textarea',
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
        return $this->name;
    }

    // Relationships

    /**
     * The beneficiaries that belong to the course.
     */
    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class);
    }

    /**
     * Lesson relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Teacher relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
