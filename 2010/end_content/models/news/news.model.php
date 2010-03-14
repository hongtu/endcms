<?php
/**
 * news model class
 *
 * @author Liu Longbill
 */

class MODEL_NEWS extends MODEL
{
	function MODEL_NEWS()
	{
		$this->table = END_MYSQL_PREFIX.'news';
		$this->id = 'news_id';
		$this->order_id = 'order_id';
	}
}