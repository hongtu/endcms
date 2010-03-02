<?php
class END_Member extends END_Model
{
	function END_Member()
	{
		$this->table = END_MYSQL_PREFIX.'member';
		$this->order_id = 'member_id';
		$this->id = 'member_id';
	}
	
	function add_detail($data)
	{
		$this->table = END_MYSQL_PREFIX.'member_detail';
		$this->add($data);
		$this->END_Member();
	}
}
?>