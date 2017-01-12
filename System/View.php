<?php

namespace System;

use System\Pattern\Singleton;

/**
 * Class View
 * @package System
 *
 * @method static View getInstance()
 */
class View
{

    use Singleton;

    const DISPLAY_VIEW   = 'view';
    const DISPLAY_LAYOUT = 'layout';

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @param $document
     */
    public function render($document)
    {
        echo $this->getDocument($document, self::DISPLAY_LAYOUT);
    }

    /**
     * @param $document
     */
    public function view($document)
    {
        $viewContent = $this->getDocument($document);

        if (null !== ($layout = Config::getInstance()->get('app', 'default_layout'))) {
            $this->assign('content', $viewContent);
            $this->render($layout);
        } else {
            echo $viewContent;
        }
    }

    /**
     * @param $document
     * @param string $type
     * @return string
     */
    protected function getDocument($document, $type = self::DISPLAY_VIEW)
    {
        $path = APP_ROOT . 'MVC/' . ($type === static::DISPLAY_LAYOUT ? 'Layout' : 'Views') . '/' . $document . '.phtml' ;

        $content = '';

        if (true === file_exists($path)) {
            ob_start();
            include $path;
            $content = ob_get_clean();
        }

        return $content;
    }

    /**
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (true === isset($this->variables[$name])) {
            return $this->variables[$name];
        }

        return null;
    }

}