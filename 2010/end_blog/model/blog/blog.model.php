<?php
/**
 * news model class
 *
 * @author Liu Longbill
 */

class MODEL_BLOG extends MODEL
{
	function MODEL_BLOG()
	{
		$this->table = END_MYSQL_PREFIX.'blog';
		$this->id = 'blog_id';
		$this->order_id = 'order_id';
	}
	
	function get($name)
	{
		return $this->get_one(array('url'=>$name));
	}
	
	function add($data)
	{
		if (!$data['url']) $data['url'] =  $data['name']?$data['name']:date('Y-m-d-H-i-s');
		$data['url'] = $this->unique_url($data['url']);
		return parent::add($data);
	}
	
	function add_view($id)
	{
		if (!$id) return;
		$GLOBALS['db']->query("UPDATE $this->table SET view_count=view_count+1 WHERE $this->id='$id' LIMIT 1");
	}
	
	function update($id,$data)
	{
		if (isset($data['url']))
		{
			$data['url'] = $this->unique_url($data['url'],$id);
		}
		return parent::update($id,$data);
	}
	
	function unique_url($url,$id=0)
	{
		if (!$url) $url = date('Y-m-d-H-i-s');
		$_i = 2;
		$_url = $url;
		while($this->exists(array('url'=>$url,'where'=>'blog_id!='.$id)))
		{
			$url = $_url.$_i;
			$_i++;
		}
		return $url;
	}
}