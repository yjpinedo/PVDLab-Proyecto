<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property mixed lesson
 */
class Beneficiary extends Base
{
    use SoftDeletes;
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
       'actions', 'full_name', 'translated_assistance'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'data', 'password', 'password_confirmation', 'remember',
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
            'fields' => ['id', 'name', 'sex', 'ethnic_group'],
            'active' => false,
            'actions' => true,
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
                'name' => 'occupation',
                'type' => 'text',
            ],
            [
                'name' => 'ethnic_group',
                'type' => 'select',
                'value' => 'app.selects.person.ethnic_group',
            ],
            [
                'name' => 'other_ethnic_group',
                'type' => 'text',
            ],
            [
                'name' => 'stratum',
                'type' => 'select',
                'value' => 'app.selects.person.stratum',
            ],
        ],
    ];

    // Mutator

    /**
     * Mutator for the actions
     *
     * @return array
     */
    public function getTranslatedAssistanceAttribute()
    {
        $assistanceLength = 0;
        $lengthLesson = 0;
        $lessons = [];

        if (count($this->lessons)) {
            foreach ($this->lessons as $lesson) {
                $lessons[] = $lesson->id;
            }
        }

        if (count($this->courses) > 0) {
            foreach ($this->courses as $course) {
                foreach ($course->lessons as $lesson) {
                    if (in_array($lesson->id, $lessons)) {
                        $assistanceLength++;
                    }
                    $lengthLesson++;
                }

                if ($assistanceLength == 0) {
                    $course->beneficiaries()->updateExistingPivot($this->id, ['progress' => __('app.selects.course.progress.INSCRITO')]);
                } else if ($lengthLesson == $assistanceLength) {
                    $course->beneficiaries()->updateExistingPivot($this->id, ['progress' => __('app.selects.course.progress.FINALIZADO')]);
                } else {
                    $course->beneficiaries()->updateExistingPivot($this->id, ['progress' => __('app.selects.course.progress.PROCESO')]);
                }

                $lengthLesson = 0;
                $assistanceLength = 0;
            }
        }

        return [
            'id' => $this->id,
            'lessons' => $lessons,
            'assistance' => 'FALLO',
            'class' => __('app.selects.lesson.assistance_class.FALLO'),
        ];
    }

    /**
     * Mutator for the actions
     *
     * @return array
     */
    public function getActionsAttribute()
    {
        return [
            'id' => $this->id,
            //'lessons' => $this->translated_assistance['lessons'],
        ];
    }

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
     * The courses that belong to the beneficiary.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('progress')->withTimestamps();
    }

    /**
     * The lessons that belong to the beneficiary.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }

    /**
     * The projects that belong to the beneficiary.
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
