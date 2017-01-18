<?php

namespace System\Database\Statement;

use System\Database\Statement;

class Insert extends Statement
{

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $values;

    /**
     * @param $columns
     */
    public function columns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @param $values
     * @return $this
     */
    public function values($values)
    {
        if (array_values($values) === $values) {
            $this->values = $values;
        } else {
            $this->columns = array_keys($values);
            $this->values = array_values($values);
        }

        return $this;
    }

    /**
     * @return int Last inserted ID
     */
    public function execute()
    {
        $this->values;
    }

}