<?php

namespace System\Form;

abstract class AbstractForm
{

    protected $validators = [];

    protected $data = [];

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
    }

}