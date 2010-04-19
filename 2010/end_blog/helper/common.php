<?php


function get_items($m,$s)
{
	$s = (is_numeric($s))?intval($s):array('alias'=>$s);
	$cat = model('category')->get_one($s);
	return model($m)->get_list(array('category_id'=>$cat['category_id']));
}

function get_cats($s)
{
	return model('category')->get_cats($s);
}


function category_link()
{
	$o = $GLOBALS['_obj'];
	if ($o['status'] == 'link')
		return $o['url'];
	else if (  $o['status'] == 'page')
		return '?p=page&cid='.$o['category_id'];
	else
		return '?cid='.$o['category_id'];
}

function item_link()
{
	$o = $GLOBALS['_obj'];
	return '?p=blog&id='.$o['blog_id'];
}


?>