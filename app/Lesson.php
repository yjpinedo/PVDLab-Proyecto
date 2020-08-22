<?php

namespace App;

class Lesson extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name','name',
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
            'fields' => ['id','date', 'course_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'course_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'date',
                'type' => 'date',
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
        return $this->date;
    }

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->date;
    }

    // Relationships

    /**
     * The beneficiaries that belong to the lesson.
     */
    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class)->withPivot('id');
    }

    /**
     * Course relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
