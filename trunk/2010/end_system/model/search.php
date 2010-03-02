<?php
class END_Search
{
	var $id = 'id';
	var $type = 'type';
	var $type_id = 'type_id';
	var $content = 'content';
	
	var $table = 'search';
	
	function END_Search()
	{
		$this->table = END_MYSQL_PREFIX.$this->table;
	}
	
	function add( $type,$type_id,$content)
	{
		global $db;
		$content = $this->chinese_words($content);
		$sql = make_insert_sql($this->table,array('type'=>$type,'type_id'=>$type_id,'content'=>$content));
		return ($db->query($sql));
	}
	
	function delete($type,$type_id)
	{
		global $db;
		$sql = "DELETE FROM $this->table WHERE `type` = '$type' && `type_id` = '$type_id';";
		return $db->query($sql);
	}
	
	function update($type,$type_id,$content)
	{
		global $db;
		$content = $this->chinese_words($content);
		$sql = make_update_sql(
			$this->table,
			array('content'=>$content), 
			array('type' => $type,'type_id' => $type_id)
			);
		return $db->query($sql);
	}

	function search( $type,$type_id,$keywords )
	{
		global $db;
		$keywords = $this->chinese_words($keywords);
		$sql = "SELECT * FROM $this->table WHERE MATCH(content) AGAINST( '$keywords' IN BOOLEAN MODE);";
		return $db->get_all($sql);
	}
	
	function chinese_words($s)
	{
		
	}

}
?>