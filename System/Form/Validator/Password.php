<?php

namespace System\Form\Validator;

/**
 * Class Password
 * @package System\Form\Validator
 */
class Password
{
    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $value;

    /**
     * Password constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return (preg_match('/^[0-9A-Za-z!@#$%\-_^:&+=§\?()]{8,50}$/', $this->value)) ? true : false;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return 'Please write your password at least 8 characters';
    }

}