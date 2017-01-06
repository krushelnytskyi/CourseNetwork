<?php

spl_autoload_register(function ($className) {
    var_dump($className);
    $file = str_replace('\\', '/', $className) . '.php';
    include_once $file;
});

// googlr