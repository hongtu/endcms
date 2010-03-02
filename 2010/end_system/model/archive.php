<?php
class END_Archive extends END_Model
{
	function END_Archive()
	{
		$this->table = END_MYSQL_PREFIX.'archive';
		$this->order_id = 'archive_id';
		$this->id = 'archive_id';
	}
	
	function delete($archive_id)
	{
		$a = $this->get_one($archive_id);
		if ($a && $a['pdf'] && file_exists($a['pdf']))
		{
			@unlink($a['pdf']);
		}
		return parent::delete($archive_id);
	}
	
}
?>