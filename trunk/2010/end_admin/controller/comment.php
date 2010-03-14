<?php
END_MODULE != 'admin' && die('Access Denied');

filter_array($_GET,'itemtype,status,intval:itemid',true);
$comment = new Comment;
$cond=array();

//order added by longbill
if ($_GET['order'] && $_GET['asc'])
	$cond['order'] = $_GET['order'].' asc';
else if ($_GET['order'])
	$cond['order'] = $_GET['order'].' desc';
else
	$cond['order']='created_at asc';

if($itemid && $itemtype && $itemtype != 'all')
{
	$cond['item_id']=$itemid;
	$cond['item_type'] = Item::$itemTypes[$itemtype];
	$item = Item::getTitle($itemid,$itemtype);
	$view_data['itemname']= $item['title'];
	$view_data['itemid']= $itemid;
}

if ($itemtype && $itemtype != 'all') $cond['item_type'] = Item::$itemTypes[$itemtype];
if (isset($_GET['status']) && $status != 'all') $cond['status'] = intval($status);
$comments = end_page($comment,$cond,20);
$view_data['comments'] = $comments;
$view_data['status'] = isset($status)?$status:'all';
$view_data['itemtype'] = isset($itemtype)?$itemtype:'all';

$view_data['statuses'] = Comment::$statusTypes;

function show_status($id)
{
	$status = Comment::$statusTypes;
	foreach($status as $arr) if ($arr['id'] == $id) return $arr['name'];
}