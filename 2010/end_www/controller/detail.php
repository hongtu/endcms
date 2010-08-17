<?php
$id = intval($_GET['id']);
if (!$id) die('404');

$product = model('product')->get_one($id);

if (!$product) die('404');

$cat = model('category')->get_one($product['category_id']);

$view_data['cat'] = $cat;
$view_data['p'] = $product;
$view_data['title'] = $product['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
