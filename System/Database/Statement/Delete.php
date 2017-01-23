<?php

namespace System\Database\Statement;
use System\Database\Statement;

class Delete extends Statement
{
    /**
     * @var string
     */
	 
    public $where = '';

    public $orderbylimit = '';
	
	
	
    /**
     * it forms one of such expressions - WHERE, OR or AND
     * depending on requirement and returns expression
     */
    public function where($expression, $variable, $delimiter, $value)
    {
		
		if ($expression == 'WHERE' && $this->where === '') {
			
			
            $this->where = ' ' . $expression . ' ' . $variable . $delimiter . $value;
			
			
			} else if ($this->where !== '') {
				
			
            $this->where = $this->where . $expression . $variable . $delimiter . $value;
        }

        return $this;
    }


	
	
	/**
     * it determines some cases when expressions ORDER BY
     * and LIMIT are need together - and returns expression
     */
    public function orderByLimit ($orderBy, $limit)  
	{
		

        if (($orderBy != '')&&($limit != 0)&&($orderBy != null)&&($limit != null)) {
			
			
            $this->orderByLimit = ' ORDER BY ' . $orderBy . ' LIMIT ' . $limit;
			
			
        } else {
			
            $this->orderByLimit = '';
			
        }
		

        return $this;
    }
	
	

    /**
     * DELETE FROM table_name
     * DELETE FROM table_name WHERE id = 2 AND email = 'email@com'
     * DELETE
     *
     * @return int
     */
    public function execute()
    {
		
        $sql = 'DELETE FROM ' . $this->table;
		

        if ($this->where !== '') {
			
			
            $sql .= ' ' . $this->where;
			
        }

        $result = $this->connection->getLink()->query($sql);
		

        if ($result !== false) {
			
			
            return $this->connection->getLink()->affected_rows;
			
        }

		
        return false;

    }
	
}