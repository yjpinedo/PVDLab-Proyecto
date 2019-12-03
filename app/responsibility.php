<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class responsibility extends Base
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
        'table' => [],
        'form' => [
            [
                'name' => 'nameBeneficiary',
                'type' => 'text',
            ],
            [
                'name' => 'documentBeneficiary',
                'type' => 'text',
            ],
            [
                'name' => 'issuedBeneficiary',
                'type' => 'text',
            ],
            [
                'name' => 'nameEmployee',
                'type' => 'text',
            ],
            [
                'name' => 'documentEmployee',
                'type' => 'text',
            ],
            [
                'name' => 'issuedEmployee',
                'type' => 'text',
            ],
        ],
    ];

}
