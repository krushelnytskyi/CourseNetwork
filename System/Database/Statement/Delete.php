<?php

namespace System\Database\Statement;
use System\Database\Statement;


class Delete extends Statement
{
	
public $delete_array_from = null;

public $where = '';
public $orderbylimit = '';
	
public function Delete_From ($delete_array_from = null) {
	
if (true == is_array($delete_array_from)) {
	
$this->delete_array_from = implode(',', $delete_array_from);
}
return $this;
}	
	
public function Where($expression, $variable, $delimiter, $value)
{
	
if (($expression != null)&&($variable != null)&&($delimiter != null)&&($value != null)) {
	
if (($expression == 'WHERE')&&($this->where = '')) {
	$this->where = $expression . $variable . $delimiter . $value;
}

else if (($expression !== 'WHERE')&&($this->where != '')) {
	$this->where = where . $expression . $variable . $delimiter . $value;
}
}

return $this;
}


public function orderByLimit ($orderBy, $limit)  {
	
if (($orderBy != '')&&($limit != 0)&&($orderBy != null)&&($limit != null)) {
$this->orderByLimit = ' ORDER BY ' . $orderBy . ' LIMIT ' . $limit;
}

else {
$this->orderByLimit = '';
}

return $this;
}


public function deleteFromDatabase()
{
	
if (false === $this->connection->getLink()) {
return null;
}

else if (true === $this->connection->getLink()) {
	
$sql = 'DELETE ' . $this->delete_array_from . ' FROM ' . $this->table . $this->where . $this->orderByLimit . ';';

return $this->connection->getLink()->query($sql);
}

}
}
