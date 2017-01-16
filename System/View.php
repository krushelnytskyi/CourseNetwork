<?php

namespace System;

use System\Pattern\Singleton;

/**
 * Class View
 * @package System
 * @method static View getInstance()
 */
class View
{

    /**
     * Document types
     */
    const TYPE_VIEW   = 'view';
    const TYPE_LAYOUT = 'layout';

    use Singleton;

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @param string $name View name
     */
    public function view($name)
    {
        $content = $this->getDocument($name, self::TYPE_VIEW);

        if (($layout = Config::getInstance()->get('app', 'default_layout')) !== null) {
            $this->assign('content', $content);
            $this->layout($layout);
        } else {
            echo $content;
        }
    }

    /**
     * @param $name string Layout name
     */
    public function layout($name)
    {
        echo $this->getDocument($name, self::TYPE_LAYOUT);
    }

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param $name
     * @param $type
     * @return string
     */
    protected function getDocument($name, $type)
    {
        $documentPath = APP_ROOT . 'MVC/' .
            ($type === static::TYPE_LAYOUT ? 'Layout' : 'Views') . '/';

        ob_start();
        include $documentPath . $name . '.phtml';
        return ob_get_clean();
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->variables[$name];
        }

        return null;
    }

    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

}