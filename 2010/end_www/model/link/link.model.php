<?php
/**
 * link model class
 *
 * @author Liu Longbill
 */

class MODEL_LINK extends MODEL
{
	function MODEL_LINK()
	{
		$this->table = END_MYSQL_PREFIX.'link';
		$this->id = 'link_id';
		$this->order_id = 'order_id';
	}
	
	function get_list($cond)
	{
		if (!isset($cond['order'])) $cond['order'] = 'order_id DESC,link_id ASC';
		return parent::get_list($cond);
	}
	
}