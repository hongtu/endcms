<?php
$id = intval($_GET['id']);
if (!$id) die('404');

$page_size = 16; //每页显示多少个

$cat = model('category')->get_one($id);
if ($cat['status'] != 'product_list') die('404');

$view_data['cat'] = $cat;

$items = end_page(model('product'),array('category_id'=>$id),$page_size);


$view_data['items'] = $items;

$view_data['title'] = $cat['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
