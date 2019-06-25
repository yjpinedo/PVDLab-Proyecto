<?php

namespace App;

class Course extends Base
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

    // Relationships

    /**
     * Teacher relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Lesson relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * beneficiaryCourse relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaryCourse()
    {
        return $this->hasMany(BeneficiaryCourse::class);
    }
}
