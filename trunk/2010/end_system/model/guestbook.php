<?php
class END_Guestbook extends END_Model
{
	function END_Guestbook()
	{
		$this->table = END_MYSQL_PREFIX.'guestbook';
		$this->id = 'guestbook_id';
		$this->order_id = 'guestbook_id';
	}
	
	function update($id,$data)
	{
		if ($data['reply_content']) $data['reply_date'] = time();
		return parent::update($id,$data);
	}
}
?>