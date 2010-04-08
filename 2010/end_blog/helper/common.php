<?php


function category_link($o)
{
	if ($o['status'] == 'link')
		return $o['url'];
	else if (  $o['status'] == 'page')
		return '?p=page&cid='.$o['category_id'];
	else
		return '?cid='.$o['category_id'];
}

function item_link($o)
{
	return '?p=blog&id='.$o['blog_id'];
}


?>