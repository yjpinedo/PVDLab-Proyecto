<?php

return [

    [
        'name' => 'beneficiary',
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
        'name' => 'employee',
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
        'name' => 'teacher',
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
        ],
    ],

];
