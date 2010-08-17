<?php
$id = intval($_GET['id']);
if (!$id) die('404');

$cat = model('category')->get_one($id);
if ($cat['status'] != 'page') die('404');

$view_data['cat'] = $cat;

$view_data['title'] = $cat['page_title']?$cat['page_title']:$cat['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
