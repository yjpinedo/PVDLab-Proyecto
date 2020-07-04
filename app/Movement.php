<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movement extends Base
{
    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name'
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
            'fields' => ['id', 'type', 'origin_id', 'destination_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'type',
                'type' => 'select',
                'value' => 'app.selects.movement.type',
            ],
            [
                'name' => 'date',
                'type' => 'date',
            ],
            [
                'name' => 'stock',
                'type' => 'text',
            ],
            [
                'name' => 'origin_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'destination_id',
                'type' => 'select_reload',
            ],
        ],
    ];

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->type;
    }

    // Relationship

    /**
     * Furniture relationship
     *
     * @return BelongsTo
     */
    public function warehouse_origin()
    {
        return $this->belongsTo(Warehouse::class, 'origin_id');
    }

    /**
     * Furniture relationship
     *
     * @return BelongsTo
     */
    public function warehouse_destination()
    {
        return $this->belongsTo(Warehouse::class, 'destination_id');
    }
}
