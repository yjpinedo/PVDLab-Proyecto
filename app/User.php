<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, Notifiable;
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'role'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'model_id', 'model_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * The data to build the layout.
     *
     * @return array
     * @var array
     */
    public function getLayout(): array
    {
        return [
            'title' => __('app.titles.users'),
            'subtitle' => __('Lista de usuarios'),
            'tools' => [
                'create' => false,
                'reload' => false,
            ],
            'table' => [
                'check' => false,
                'fields' => ['id', 'name', 'email',  'state', 'role_id'],
                'active' => false,
                'actions' => false,
            ],
            'form' => [
                [
                    'name' => 'user_id',
                    'type' => 'select_reload',
                ],
                [
                    'name' => 'role_id',
                    'type' => 'select_reload',
                ],
            ],
        ];
    }

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getRoleAttribute()
    {
        return $this->getRoleNames();
    }

    /**
     * Set baseQuery variable
     *
     * @param string $field
     * @return array
     */
    public function select($field = 'select_value')
    {
        return $this->get()->sortBy($field)->pluck($field, 'id');
    }

    /**
     * Mutator for the value to show in the select
     *
     * @return string
     */
    public function getSelectValueAttribute(): string
    {
        return $this->name;
    }

}
