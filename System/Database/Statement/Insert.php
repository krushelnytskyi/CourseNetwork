<?php

namespace System\Database\Statement;

use System\Database\Statement;

class Insert extends Statement
{

    protected $values;

    /**
     * @param $values
     * @return $this
     */
    public function values($values)
    {
        $this->values = $values;
        return $this;
    }

    public function execute()
    {
        $this->values;
    }

}