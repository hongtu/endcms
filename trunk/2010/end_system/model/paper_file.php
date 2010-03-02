<?php
class END_Paper_File extends END_Model
{
	function END_Paper_File()
	{
		$this->table = END_MYSQL_PREFIX.'paper_file';
		$this->id = 'file_id';
		$this->order_id = 'paper_id';
	}
}
?>