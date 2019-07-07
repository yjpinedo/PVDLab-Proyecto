<?php

namespace App;

class Furniture extends Base
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
            'fields' => ['code', 'name', 'serial', 'category_id', 'location_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'category_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'location_id',
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
                'name' => 'brand',
                'type' => 'text',
            ],
            [
                'name' => 'serial',
                'type' => 'text',
            ],
            [
                'name' => 'pattern',
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
     * Category Category relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Location relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * The transfers that belong to the furniture.
     */
    public function transfers()
    {
        return $this->belongsToMany(Transfer::class);
    }
}
