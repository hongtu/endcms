<?php
END_MODULE != 'admin' && die('Access Denied');

filter_array($_GET,'itemtype',true);
$obj_rating = new Rating;
$cond=array();

//排序 added by longbill
if ($_GET['order'] && $_GET['asc'])
	$cond['order'] = $_GET['order'].' asc';
else if ($_GET['order'])
	$cond['order'] = $_GET['order'].' desc';
else
	$cond['order']='rating_id DESC';

//使用视图后不需要此条件了 $cond['item_type'] = $itemtype;
$rt = end_page($obj_rating,$cond,20);
$view_data['ratings'] = $rt;