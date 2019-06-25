<?php

namespace App;

/**
 * @property mixed transfer
 * @property mixed furniture
 */
class FurnitureTransfer extends Base
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
            'fields' => ['id',  'transfer_id', 'furniture_id'],
            'active' => false,
            'actions' => false,
        ],
        'form' => [
            [
                'name' => 'transfer_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'furniture_id',
                'type' => 'select_reload',
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
        return  $this->transfer->type . ' - ' . $this->furniture->name;
    }

    // Relationships

    /**
     * Transfer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    /**
     * Furniture relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
