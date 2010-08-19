<?php

if (!$_SESSION['user']['user_id'])
{
	header('Location:?login');
	die;
}

if ($_SESSION['coupon'] != '')
{
	$c = model('coupon')->get_one(array('name'=>$_SESSION['coupon']));
	if ($c)
	{
		$shipping = $_SESSION['shipping_price'];
		$total = $_SESSION['total'];
		$subtotal = 0;
		foreach($_SESSION['cart'] as $pid => $p)
		{
			if ($p['qty'] > 0)
			{
				$price = ($_SESSION['user']['status'] == 2)?$p['wholesale']:$p['retail'];
				$subtotal += $price*$p['qty'];
			}
		}
		$view_data['coupon_price'] = model('coupon')->get_price($_SESSION['coupon'],$subtotal,$shipping,$total);
		$view_data['coupon_desc'] = $c['name'].'('.$c['description'].')';
	}
	
	if (!$c || $view_data['coupon_price'] <= 0)
	{
		$view_data['coupon_desc'] = '<span style="color:red">invalid</span>';		
	}
}

if (!$view_data['coupon_price']) $view_data['coupon_price'] = 0;

$_SESSION['billing_information'] = $view_data['billing'] = $_POST['billing'];
$_SESSION['shipping_information'] = $view_data['shipping'] = $_POST['shipping'];

$view_data['title'] = 'Checkout confirmation';
$view_data['coupon'] = $_SESSION['coupon'];