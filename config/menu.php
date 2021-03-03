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
            [
                'crud' => 'beneficiary.loans',
                'icon' => 'fas fa-dolly',
            ],
            [
                'icon' => 'fas fa-user-cog',
                'name' => 'beneficiary.profile',
                'submenu' => [
                    [
                        'crud' => 'beneficiary.profile',
                    ],
                    [
                        'crud' => 'beneficiary.update-password',
                    ],
                ],
            ],
        ],
    ],

    [
        'name' => 'employees',
        'menu' => [
            [
                'crud' => 'employee.projects',
                'icon' => 'fa fa-project-diagram',
            ],
            [
                'crud' => 'employee.beneficiaries',
                'icon' => 'fa fa-users',
            ],
            [
                'crud' => 'employee.formats',
                'icon' => 'fa fa-file-alt',
            ],
            [
                'icon' => 'fa fa-clipboard-list',
                'name' => 'employee.courses',
                'submenu' => [
                    [
                        'crud' => 'employee.courses',
                    ],
                    [
                        'crud' => 'employee.teachers',
                    ],
                ],
            ],
            [
                'icon' => 'fa fa-exchange-alt',
                'name' => 'employee.movements',
                'submenu' => [
                    /*[
                        'crud' => 'employee.categories',
                    ],*/
                    [
                        'crud' => 'employee.warehouses',
                    ],
                    [
                        'crud' => 'employee.articles',
                    ],
                    [
                        'crud' => 'employee.movements',
                    ],
                    [
                        'crud' => 'employee.loans',
                    ],
                ],
            ],
            [
                'icon' => 'fas fa-user-cog',
                'name' => 'employee.profile',
                'submenu' => [
                    [
                        'crud' => 'employee.profile',
                    ],
                    [
                        'crud' => 'employee.update-password',
                    ],
                ],
            ],
        ],
    ],

    [
        'name' => 'teachers',
        'menu' => [
            [
                'crud' => 'teacher.courses',
                'icon' => 'fa fa-clipboard-list',
            ],
            [
                'icon' => 'fas fa-user-cog',
                'name' => 'teacher.profile',
                'submenu' => [
                    [
                        'crud' => 'teacher.profile',
                    ],
                    [
                        'crud' => 'teacher.update-password',
                    ],
                ],
            ],
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
                'crud' => 'users',
                'icon' => 'fa fa-user-cog',
            ],
            [
                'icon' => 'fas fa-chart-bar',
                'name' => 'dashboard',
                'submenu' => [
                    [
                        'crud' => 'dashboards.users',
                    ],/*
                    [
                        'crud' => 'teachers',
                    ],*/
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
           [
                'icon' => 'fa fa-exchange-alt',
                'name' => 'movements',
                'submenu' => [
                    [
                        'crud' => 'categories',
                    ],
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
