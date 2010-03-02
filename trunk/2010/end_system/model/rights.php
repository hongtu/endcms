<?php
class END_Rights extends END_Model
{
	function END_Rights()
	{
		$this->table = END_MYSQL_PREFIX.'rights';
		$this->id = 'rights_id';
		$this->order_id = 'order_id';
	}
}
?>