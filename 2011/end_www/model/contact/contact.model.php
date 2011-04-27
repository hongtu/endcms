<?php
/**
 * contact model class
 *
 * @author Liu Longbill
 */

class MODEL_CONTACT extends MODEL
{
	function MODEL_CONTACT()
	{
		$this->table = END_MYSQL_PREFIX.'contact';
		$this->id = 'contact_id';
	}
	
	function add($data)
	{
		$data['create_time'] = date('Y-m-d H:i:s');
		return parent::add($data);
	}
}