<?php
/**
 * news model class
 *
 * @author Liu Longbill
 */

class MODEL_BLOG extends MODEL
{
	function MODEL_BLOG()
	{
		$this->table = END_MYSQL_PREFIX.'blog';
		$this->id = 'blog_id';
		$this->order_id = 'order_id';
	}
}