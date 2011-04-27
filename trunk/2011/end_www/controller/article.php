<?php
$id = intval($_GET['id']);
if (!$id) die('404');

$article = model('article')->get_one($id);
if (!$article) die('404');

$cat = model('category')->get_one($article['category_id']);



$children = model('category')->get_list(array('parent_id'=>$cat['category_id']));
if (!$children)
{
	$children = model('category')->get_list(array('parent_id'=>$cat['parent_id']));
	$view_data['parent'] = model('category')->get_one($cat['parent_id']);
	if ($view_data['parent']['url'] == 'navigations') $view_data['parent'] = $cat;
	if ($view_data['parent']['category_id'] == 0)
	{
		$view_data['parent'] = $cat;
		$children = get_cats('navigations');
	}
}
else
{
	$view_data['parent'] = $cat;
}
$view_data['children'] = $children;


$view_data['cat'] = $cat;
$view_data['a'] = $article;
$view_data['title'] = $article['name'];
$view_data['description'] = $cat['description'];
$view_data['keywords'] = $cat['keywords'];
