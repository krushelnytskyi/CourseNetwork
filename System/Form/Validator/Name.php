<?php

namespace System\Form\Validator;

/**
 * Class Name
 * @package System\Form\Validator
 */
class Name
{
    /**
     * @var
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * Name constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = trim($value);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return (preg_match('/^(?![\d_])[0-9A-Z_a-z\s]{3,20}$/', $this->value)) ? true : false;
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
        return 'Can you input normal name?';
    }
}
