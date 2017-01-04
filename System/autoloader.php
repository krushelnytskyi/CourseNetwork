<?php

spl_autoload_register(function ($className) {
	$file = str_replace('\\', '/', $className) . '.php';
	
	if( file_exists($file) == true ) {
		include_once $file;
	}
});