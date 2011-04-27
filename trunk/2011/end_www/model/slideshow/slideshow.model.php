<?php
/**
 * slideshow model class
 *
 * @author Liu Longbill
 */

class MODEL_SLIDESHOW extends MODEL
{
	function MODEL_SLIDESHOW()
	{
		$this->table = END_MYSQL_PREFIX.'slideshow';
		$this->id = 'slideshow_id';
		$this->order_id = 'order_id';
	}
	
}