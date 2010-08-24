<?php
/**
 * product model class
 *
 * @author Liu Longbill
 */

class MODEL_PRODUCT extends MODEL
{
	function MODEL_PRODUCT()
	{
		$this->table = END_MYSQL_PREFIX.'product';
		$this->id = 'product_id';
		$this->order_id = 'order_id';
	}
	
	function get_brands($cond = array())
	{
		$cond['select'] = 'DISTINCT(brand)';
		return parent::get_list($cond);
	}
	
	function get_carriers($cond = array())
	{
		$cond['select'] = 'DISTINCT(carrier)';
		return parent::get_list($cond);
	}
	
}