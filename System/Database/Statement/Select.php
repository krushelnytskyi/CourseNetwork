<?php

namespace System\Database\Statement;

use System\Database\Statement;

class Select extends Statement
{

    /**
     * @var array|string
     */
    protected $columns = '*';

    /**
     * @param $columns
     * @return $this
     */
    public function columns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function where($criteria)
    {
    }

    public function execute()
    {
    }

}