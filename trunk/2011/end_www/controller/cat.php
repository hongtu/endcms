<?php
$url = $_GET['id'];
if (!$url) die('404');
$url = urldecode($url);

$cat = model('category')->get_one(array('url'=>$url));
if (!$cat || $cat['status'] != 'article_list') die('404');

$view_data['cat'] = $cat;
$children = model('category')->get_list(array('parent_id'=>$cat['category_id']));
if (!$children)
{
	$children = model('category')->get_list(array('parent_id'=>$cat['parent_id']));
	$view_data['parent'] = model('category')->get_one($cat['parent_id']);
	if ($view_data['parent']['url'] == 'navigations') $view_data['parent'] = $cat;
	$cond = array('category_id'=>$cat['category_id']);
	if ($view_data['parent']['category_id'] == 0)
	{
		$view_data['parent'] = $cat;
		$children = get_cats('navigations');
	}
}
else
{
	$view_data['parent'] = $cat;
	$ids = array($cat['category_id']);
	foreach($children as $_c)
	{
		$ids[] = $_c['category_id'];
	}
	$cond = array('where'=>'category_id IN ('.join(',',$ids).')');
}

$view_data['children'] = $children;

$o_cond = $cond;
$cond['is_photo'] = 0;
$cond['select'] = 'count(1) as total';
$arr = model('article')->get_one($cond);
$view_data['is_gallery'] = $arr['total'] == 0;
$page_size = $view_data['is_gallery']?9:20;
$view_data['items'] = end_page(model('article'),$o_cond,$page_size);



$view_data['title'] = $cat['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
