<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Base
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
            'fields' => ['code', 'name'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
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
     * Employee relationship
     *
     * @return HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
