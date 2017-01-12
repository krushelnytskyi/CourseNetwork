	<?php

define('APP_ROOT', __DIR__ . '/');

include_once 'System/autoloader.php';

\System\Dispatcher::getInstance()->dispatch();