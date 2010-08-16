<?php
class MODEL_TAG extends MODEL
{
	function MODEL_TAG()
	{
		$this->table = END_MYSQL_PREFIX.'tag';
		$this->order_id = NULL;
		$this->id = 'tag_id';
	}
	
	function add_tags($item_type,$item_id,$tags)
	{
		global $db;
		$tags = preg_replace('/(\s+|\,|，|。)/',',',$tags);
		$tag_arr = explode(',',$tags);
		foreach($tag_arr as $t)
		{
			$tag_id = $this->set(array('name'=>$t),array('name'=>$t));
			if ($tag_id)
			{
				//delete old relation
				$db->query("DELETE FROM ".END_MYSQL_PREFIX."tag_relation WHERE tag_id='$tag_id'");
				
			}
		}
	}
	
}
?>