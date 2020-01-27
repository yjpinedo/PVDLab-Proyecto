<?php

namespace App;

class Format extends Base
{
    /**
     * The data to build the layout.
     *
     * @var array
     */
    protected $layout = [
        'tools' => [
            'create' => false,
            'reload' => false,
        ],
        'table' => [
            'check' => false,
            'fields' => ['id', 'name'],
            'active' => false,
            'actions' => false,
            ],
        'form' => [
            [
                'name' => 'beneficiary_id',
                'type' => 'select_reload',
            ],
        ],
    ];

}
