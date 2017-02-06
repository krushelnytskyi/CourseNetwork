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
        ],
        'projects/create-project' => [
            'controller' => \MVC\Controllers\Projects::class,
            'action' => 'createProject'
        ]
    ],
    'patterns' => [
//        'users\/(.+)' => [
//            'controller' => 'MVC\Controllers\User',
//            'action' => '$1'
//        ]
    ]
];