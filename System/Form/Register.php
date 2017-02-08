<?php

namespace System\Form;

use System\Form\Validator\Name;
use System\Form\Validator\Email;
use System\Form\Validator\Password;

/**
 * Class Register
 * @package System\Form
 */
class Register extends AbstractForm
{

    /**
     * Register constructor.
     * @param $data
     */
    public function __construct($data)
    {

        $this->data = $data;

        $this->validators = [

            new Name('name', $this->data['name']),
            new Email('email', $this->data['email']),
            new Password('password', $this->data['password'])

        ];

    }

}