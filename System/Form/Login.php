<?php

namespace System\Form;

use System\Form\Validator\Email;

class Login extends AbstractForm
{

    public function __construct($data)
    {

        $this->data = $data;

        $this->validators = [

            new Email('email', $this->data['email']),
            new Password('password', $this->data['email'])

        ];

    }

}