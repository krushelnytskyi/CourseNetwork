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
//        ]
    ]
];