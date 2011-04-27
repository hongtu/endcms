<?php
/**
 * article model class
 *
 * @author Liu Longbill
 */

class MODEL_ARTICLE extends MODEL
{
	function MODEL_ARTICLE()
	{
		$this->table = END_MYSQL_PREFIX.'article';
		$this->id = 'article_id';
		$this->order_id = 'order_id';
	}
	
	function add($data)
	{
		$data['img'] = MODEL_ARTICLE::get_photo_src($data['content']);
		$data['create_time'] = time();
		return parent::add($data);
	}
	
	function update($id,$data)
	{
		$data['img'] = MODEL_ARTICLE::get_photo_src($data['content']);
		return parent::update($id,$data);
	}
	
	static function get_photo_src($s)
	{
		preg_match('/<img\s[^>]+>/i',$s,$ms);
		preg_match('/src\=([\'\"])([^\'\"]+)\1/i',$ms[0],$_ms);
		return $_ms[2];
	}
	
}