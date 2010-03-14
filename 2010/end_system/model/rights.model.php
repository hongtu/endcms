<?php
class MODEL_RIGHTS extends MODEL
{
	function END_Rights()
	{
		$this->table = END_MYSQL_PREFIX.'rights';
		$this->id = 'rights_id';
		$this->order_id = 'order_id';
	}
}
?>