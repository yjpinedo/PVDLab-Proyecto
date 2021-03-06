<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loan extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'actions', 'full_name', 'translated_state',
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
            'fields' => ['id', 'name', 'employee_id', 'beneficiary_id', 'created_at', 'state'],
            'active' => false,
            'actions' => true,
        ],
        'form' => [],
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
            'beneficiary_id' => $this->beneficiary->id,
            'cancel' => $this->state == 'PENDIENTE',
            'approved' => $this->state == 'APROBADO',
            'next' => __('app.selects.loan.state_next.' . $this->state),
        ];
    }

    /**
     * Mutator for the actions
     *
     * @return array
     */
    public function getTranslatedStateAttribute()
    {
        return [
            'state' => $this->state,
            'class' => __('app.selects.project.concept_class.' . $this->state),
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
     * Mutator for the created at
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @return BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_loan')->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    /**
     * @return BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
