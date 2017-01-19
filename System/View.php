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
     * @var string
     */
    private $innerBody;

    /**
     * @var null|string
     */
    private $innerLayout;

    /**
     * View constructor.
     * @param null $view
     */
    public function __construct($view = null)
    {
        if (null !== $view) {
            $this->view($view);
        }
    }

    /**
     * @param $name
     * @return string
     */
    public function view($name)
    {
        $this->innerBody = $name;
        return $this;
    }

    /**
     * @param $name
     * @return string
     */
    public function layout($name)
    {
        $this->innerLayout = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        $body = '';

        if ($this->innerBody !== null) {
            $body = $this->getDocument($this->innerBody, static::TYPE_VIEW);
        }

        if ($this->innerLayout !== null) {
            $this->assign('content', $body);
            $body = $this->getDocument($this->innerLayout, static::TYPE_LAYOUT);
        }

        return $body;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function assign($name, $value = null)
    {
        if (true === is_array($name)) {
            $this->variables += $name;
        } else {
            $this->variables[$name] = $value;
        }

        return $this;
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

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->variables[$name]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getBody();
    }

}