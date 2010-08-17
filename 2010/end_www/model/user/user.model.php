<?php
/**
 * user model class
 *
 * @author Liu Longbill
 */

class MODEL_USER extends MODEL
{
	function MODEL_USER()
	{
		$this->table = END_MYSQL_PREFIX.'user';
		$this->id = 'user_id';
		$this->order_id = 'user_id';
	}
}