<?php
$id = intval($_GET['id']);
if (!$id) die('404');

$page_size = 16; //每页显示多少个

$cat = model('category')->get_one($id);
if ($cat['status'] != 'product_list') die('404');

$view_data['cat'] = $cat;


$cond = array('category_id'=>$id);
if ($_GET['brand']) $cond['brand'] = $_GET['brand'];
if ($_GET['carrier']) $cond['carrier'] = $_GET['carrier'];

$view_data['cond'] = $cond;
$items = end_page(model('product'),$cond,$page_size);


$view_data['items'] = $items;

$view_data['title'] = $cat['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
