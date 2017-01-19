<?php

/** @var \System\Config $this  */

return [

    'errors' => [
        'notFound' => function () {
            \System\Dispatcher::getInstance()->output(\MVC\Controllers\Error::class, 'notFoundAction');
        },

        'exception' => function () {
            \System\Dispatcher::getInstance()->output(\MVC\Controllers\Error::class, 'errorAction');
        }
    ]

];