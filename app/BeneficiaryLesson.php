<?php

namespace App;

/**
 * @property mixed beneficiary
 * @property mixed lesson
 */
class BeneficiaryLesson extends Base
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
            'fields' => ['id', 'beneficiary_id', 'lesson_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'beneficiary_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'lesson_id',
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
        return $this->beneficiary->name . ' ' . $this->beneficiary->last_name . ' - ' . $this->lesson->date;
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
     * Course relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
