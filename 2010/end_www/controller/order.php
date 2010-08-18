<?php

if (!$_SESSION['user']['user_id'])
{
	header('Location:?login');
	die;
}

$view_data['orders'] = end_page(model('order'),array('user_id'=>$_SESSION['user']['user_id']),10);

$view_data['title'] = 'Order History';