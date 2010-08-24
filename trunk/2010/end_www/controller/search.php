<?php
$q = $_GET['q'];
$id = $_GET['id'];
$cid = intval($_GET['cid']);

if ($id == 'special')
{
	$cond = array('special'=>1);
	$view_data['special'] = true;
}
else
{
	$cond = array('where'=>"(`name` LIKE '%{$q}%' OR `brand` LIKE '%{$q}%' OR `carrier` LIKE '%{$q}%')");
	if ($cid > 0) $cond['category_id'] = $cid;
}

$page_size = 20; //每页显示多少个

$items = end_page(model('product'),$cond,$page_size);


$view_data['items'] = $items;

$view_data['title'] = 'Search result of '.$q;
