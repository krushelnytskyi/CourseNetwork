<?php

namespace System\Form;

/**
 * Class AbstractForm
 * @package System\Form
 */
abstract class AbstractForm
{
    /**
     * @var array
     */
    protected $validators = [];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $messages = [

        // 'email' => 'Email is not valid'

    ];


    public function isValid()
    {
        foreach ($this->validators as $validator) {

            if  ($validator->isValid() === false) {
                $this->messages[$validator->getName()] =
                    $validator->getMessage();

            }

        }

        return ((count($this->messages)) == 0) ? true : false;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

}