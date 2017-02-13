<?php

return [
    'urls' => [
        '' => [
            'controller' => \MVC\Controllers\Home::class,
            'action'     => 'index'
        ],
        'admin/create-category' => [
            'controller' => \MVC\Controllers\Admin::class,
            'action' => 'createCategory'
        ]
    ],
    'patterns' => [
//        'users\/(.+)' => [
//            'controller' => 'MVC\Controllers\User',
//            'action' => '$1'
//        ],
        'projects\/project\/[0-9]+' => [
            'controller' => \MVC\Controllers\Projects::class,
            'action'     => 'project'
        ],
        'projects\/category\/[0-9]+' => [
            'controller' => \MVC\Controllers\Projects::class,
            'action'     => 'search'
        ],
        'freelancers\/category\/[0-9]+' => [
            'controller' => \MVC\Controllers\Freelancers::class,
            'action'     => 'search'
        ]
    ]
];

