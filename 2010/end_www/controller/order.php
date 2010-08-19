<?php

if (!$_SESSION['user']['user_id'])
{
	header('Location:?login');
	die;
}

include_once(END_ROOT.'end_www/model/order/order.config.php');

if ($_GET['id'])
{
	$view_data['order'] = model('order')->get_one(array('order_id'=>$_GET['id'],'user_id'=>$_SESSION['user']['user_id']));
	if ($view_data['order'] && $view_data['order']['product_ids'])
	{
		$ps = explode(',',$view_data['order']['product_ids']);
		$view_data['products'] = array();
		foreach($ps as $_p)
		{
			list($pid,$qty) = explode('=',$_p);
			$arr = model('product')->get_one($pid);
			$arr['qty'] = $qty;
			$view_data['products'][$pid] = $arr;
		}
	}
}
else
{
	$view_data['orders'] = end_page(model('order'),array('user_id'=>$_SESSION['user']['user_id']),5);
}

$view_data['title'] = 'Order History';