<?php

class END_Admin extends END_Model
{
	function END_Admin()
	{
		$this->table = END_MYSQL_PREFIX.'admin';
		$this->id = 'admin_id';
		$this->order_id = 'admin_id';
	}
	
	function exists($name)
	{
		return parent::exists( array('name'=>$name));
	}
	
	function check_password($name,$password)
	{
		return parent::get_one( array('name'=>$name,'password'=>$password));
	}
	
	function get_array()
	{
		$arr = $this->get_list();
		$re = array();
		foreach($arr as $user)
		{
			$re[$user[$this->id]] = $user['name'];
		}
		return $re;
	}
}
