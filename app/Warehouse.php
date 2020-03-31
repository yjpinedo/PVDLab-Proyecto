<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Base
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
            'fields' => ['code', 'name',],
            'active' => false,
            'actions' => true,
        ],
        'form' => [
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
     * Furniture relationship
     *
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
