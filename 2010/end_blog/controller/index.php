<?php

//从blog_cats分类的子分类中列举所有日志
$ids = array();
foreach(get_cats('blog_cats') as $c)
{
	$ids[] = $c['category_id'];
}
$ids = join(',',$ids);

$view_data['items'] = end_page(model('blog'),array('status'=>1,'where'=>'category_id IN ('.$ids.')','order'=>'order_id DESC,create_time DESC'),5);
$view_data['title'] = '首页';