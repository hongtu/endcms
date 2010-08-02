<?php
/**
 * link model class
 *
 * @author Liu Longbill
 */

class MODEL_FRIENDLINK extends MODEL
{
	function MODEL_FRIENDLINK()
	{
		$this->table = END_MYSQL_PREFIX.'friendlink';
		$this->id = 'friendlink_id';
		$this->order_id = 'order_id';
	}
	
}