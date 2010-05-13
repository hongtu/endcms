<?php
$n = $_GET['argv'][0];
if (!$n) die('404');
$cat = model('category')->get_one(array('url'=>$n));
if (!$cat) die('404');
$view_data['items'] = end_page(model('blog'),array('status'=>1,'category_id'=>$cat['category_id'],'order'=>'order_id DESC,create_time DESC'),5);
$view_data['title'] = $cat['name'];
$_viewer = 'index.html';