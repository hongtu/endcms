<?php
$q = $_GET['q'];
$cid = intval($_GET['cid']);

$cond = array('where'=>"`name` LIKE '%{$q}%'");
if ($cid > 0) $cond['category_id'] = $cid;

$page_size = 20; //每页显示多少个

$items = end_page(model('product'),$cond,$page_size);


$view_data['items'] = $items;

$view_data['title'] = 'Search result of '.$q;
