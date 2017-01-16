<?php

namespace System\Database\Statement;

use System\Database\Statement;

class Insert extends Statement
{

    protected $values;

    /**
     * @param mixed $values
     *
     *
     *
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    public function execute()
    {
        $this->values;
    }

}