<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Base
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
            'fields' => ['code', 'name', 'serial', 'category_id',],
            'active' => false,
            'actions' => true,
        ],
        'form' => [
            [
                'type' => 'section',
                'value' => 'app.sections.article_information',
            ],
            [
                'name' => 'category_id',
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
            [
                'type' => 'section',
                'value' => 'app.sections.warehouse_information',
            ],
            [
                'name' => 'warehouse_id',
                'type' => 'select_reload',
            ],
            [
                'name' => 'stock',
                'type' => 'text',
            ],
        ],
        'toolsWarehouse' => [
            'create' => false,
            'reload' => false,
        ],
        'tableWarehouse' => [
            'check' => false,
            'fields' => ['code', 'name', 'stock'],
            'active' => false,
            'actions' => false,
        ],
    ];

    // Relationships

    /**
     * Category Category relationship
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Warehouse relationship
     *
     * @return BelongsToMany
     */
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'article_warehouse')->withPivot('stock')->withTimestamps();
    }
}
