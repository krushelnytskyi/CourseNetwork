<?php

spl_autoload_register(function ($className) {
	if (false === class_exists($className)) {
        $file = str_replace('\\', '/', $className) . '.php';

        if (true === file_exists($file)) {
            include_once $file;
        }
    }
});