<?php

namespace App;

class Beneficiary extends Base
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
        ],
        'table' => [
            'check' => false,
            'fields' => ['id', 'name', 'last_name', 'sex', 'ethnic_group'],
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
                'name' => 'stratum',
                'type' => 'select',
                'value' => 'app.selects.person.stratum',
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
     * beneficiaryCourse relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaryCourse()
    {
        return $this->hasMany(BeneficiaryCourse::class);
    }

    /**
     * beneficiaryCourse relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaryLesson()
    {
        return $this->hasMany(BeneficiaryLesson::class);
    }

    /**
     * BeneficiaryProject relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectBeneficiary()
    {
        return $this->hasMany(BeneficiaryProject::class);
    }

    /**
     * Transfer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
}
