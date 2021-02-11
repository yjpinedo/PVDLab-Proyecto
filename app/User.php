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
                'fields' => ['id', 'name', 'email'],
                'active' => false,
                'actions' => false,
            ],
            'form' => [
                [
                    'name' => 'beneficiary_id',
                    'type' => 'select_reload',
                ],
                [
                    'name' => 'role_id',
                    'type' => 'select_reload',
                ],
            ],
        ];
    }
}
