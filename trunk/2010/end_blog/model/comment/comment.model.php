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
	
	function get_recent($t=10)
	{
		return $GLOBALS['db']->get_all("SELECT a.*,b.url as blog_url FROM `".END_MYSQL_PREFIX."comment` a,`".END_MYSQL_PREFIX."blog` b WHERE a.status=1 AND a.blog_id=b.blog_id ORDER BY a.`time` DESC LIMIT $t");
	}
	
}