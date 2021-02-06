<?php

return [

    [
        'name' => 'beneficiaries',
        'menu' => [
            [
                'crud' => 'beneficiary.projects',
                'icon' => 'fa fa-project-diagram',
            ],
            [
                'crud' => 'beneficiary.courses',
                'icon' => 'fa fa-clipboard-list',
            ],
            [
                'crud' => 'beneficiary.courses_lists',
                'icon' => 'fa fa-book-open',
            ],
        ],
    ],

    [
        'name' => 'employees',
        'menu' => [
            [
                'crud' => 'employee.transfers',
                'icon' => 'fa fa-exchange-alt',
            ],
            [
                'crud' => 'employee.beneficiaries',
                'icon' => 'fa fa-users',
            ],
            [
                'crud' => 'employee.projects',
                'icon' => 'fa fa-project-diagram',
            ],
        ],
    ],

    [
        'name' => 'teachers',
        'menu' => [
            [
                'crud' => 'teacher.courses',
                'icon' => 'fa fa-clipboard-list',
            ],/*
            [
                'crud' => 'teacher.lessons',
                'icon' => 'fa fa-list-ul',
            ],*/
        ],
    ],

    [
        'name' => 'admin',
        'menu' => [
            [
                'crud' => 'projects',
                'icon' => 'fa fa-project-diagram',
            ],
            [
                'crud' => 'beneficiaries',
                'icon' => 'fa fa-users',
            ],
            [
                'crud' => 'formats',
                'icon' => 'fa fa-file-alt',
            ],
            [
                'icon' => 'fa fa-clipboard-list',
                'name' => 'courses',
                'submenu' => [
                    [
                        'crud' => 'courses',
                    ],
                    [
                        'crud' => 'teachers',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-user-tie',
                'name' => 'employees',
                'submenu' => [
                    [
                        'crud' => 'employees',
                    ],
                    [
                        'crud' => 'positions',
                    ],
                ],
            ],
           [
                'icon' => 'fa fa-exchange-alt',
                'name' => 'movements',
                'submenu' => [
                    [
                        'crud' => 'warehouses',
                    ],
                    [
                        'crud' => 'articles',
                    ],
                    [
                        'crud' => 'movements',
                    ],
                    [
                        'crud' => 'loans',
                    ],
                ],
            ],
        ],
    ],

];

/*
 * [
                'icon' => 'fa fa-boxes',
                'name' => 'furniture',
                'submenu' => [
                    [
                        'crud' => 'transfers',
                    ],
                    [
                        'crud' => 'furniture',
                    ],
                    [
                        'crud' => 'locations',
                    ],
                    [
                        'crud' => 'categories',
                    ],
                ],
            ],
 *
 * */
