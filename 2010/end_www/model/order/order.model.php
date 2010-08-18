<?php
/**
 * order model class
 *
 * @author Liu Longbill
 */

class MODEL_ORDER extends MODEL
{
	function MODEL_ORDER()
	{
		$this->table = END_MYSQL_PREFIX.'order';
		$this->id = 'order_id';
		$this->order_id = 'create_time';
	}
}