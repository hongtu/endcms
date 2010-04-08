<?php
/**
 * comment model class
 *
 * @author Liu Longbill
 */

class MODEL_COMMENT extends MODEL
{
	function MODEL_COMMENT()
	{
		$this->table = END_MYSQL_PREFIX.'comment';
		$this->id = 'comment_id';
		$this->order_id = NULL;
	}
	
}