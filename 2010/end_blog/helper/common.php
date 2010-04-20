<?php

/**
 * 执行sql，并返回数组
 *
 * @param string $sql 
 * @return array(array,....)
 * 2010-04-20
 */
function sql($sql)
{
	global $db;
	return $db->get_all($sql);
}

/**
 * 根据category的id或者alias获得其下的内容列表
 *
 * @param string $s category_id(int)或者alias(string)
 * @param array $cond 条件数组
 * @return array(array,...)
 * 2010-04-20
 */
function get_items($s,$cond=array())
{
	//判断是否是id
	$s = (is_numeric($s))?intval($s):array('alias'=>$s);
	//获得对应栏目
	$cat = model('category')->get_one($s);
	//获得栏目对应内容类型
	$item_type = preg_replace('/\_list$/','',$cat['status']);
	
	if (!is_array($cond))
	{
		$_tmp = $cond;
		$cond = array('where'=>$_tmp);
		unset($_tmp);
	}
	$cond['category_id'] = $cat['category_id'];
	return model($item_type)->get_list($cond);
}

/**
 * 根据category的id或者 alias获得其下的所有栏目
 *
 * @param string $s category_id(int)或者alias(string)
 * @return array(array,...)
 * 2010-04-20
 */
function get_cats($s)
{
	return model('category')->get_cats($s);
}

/**
 * 通过category对象数组获得栏目链接
 *
 * @param array $o 栏目对象数组，比如:array('category_id'=>1,'name'=>'栏目名' ... )
 * @return string 
 * 2010-04-20
 */
function category_link($o=false)
{
	if (!$o) $o = $GLOBALS['view_data'];
	if ($o['status'] == 'link')
		return $o['url'];
	else if (  $o['status'] == 'page')
		return '?p=page&cid='.$o['category_id'];
	else
		return '?cid='.$o['category_id'];
}

/**
 * 通过item对象数组获得其链接
 *
 * @param array $o item对象数组，比如:array('item_id'=>1,'name'=>'xxx' ... )
 * @return string 
 * 2010-04-20
 */
function item_link($o=false)
{
	if (!$o) $o = $GLOBALS['view_data'];
	return '?p=blog&id='.$o['blog_id'];
}



/*
获得过去多久
比如 3秒  5小时  7天
*/
function get_past_time($t,$second='秒',$minite='分',$hour='小时',$day='天',$month='月',$year='年')
{
	$d = time()-$t;
	if ($d < 60)
	{
		return $d.$second;
	}
	$d = intval($d/60);
	if ($d < 60)
	{
		return $d.$minite;
	}
	$d = intval($d/60);
	if ($d < 24)
	{
		return $d.$hour;
	}
	$d = intval($d/24);
	if ($d < 30)
	{
		return $d.$day;
	}
	$d = intval($d/30);
	if ($d < 12)
	{
		return $d.$month;
	}
	return intval($d/12).$year;
}

?>