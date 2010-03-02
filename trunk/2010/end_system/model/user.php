<?php
class END_User extends END_Model
{
	function END_User()
	{
		$this->table = END_MYSQL_PREFIX.'user';
		$this->id = 'user_id';
		$this->order_id = 'user_id';
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
?>