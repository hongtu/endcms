<?php

$pid = intval($_POST['pid']);
$qty = intval($_POST['qty']);
$action = $_GET['action'];
if (!$_SESSION['cart']) $_SESSION['cart'] = array();

if ($action == 'add')
{
	$p = model('product')->get_one($pid);
	$p['qty'] = $qty;
	$_SESSION['cart'][$pid] = $p;
}
else if ($action == 'remove')
{
	unset($_SESSION['cart'][$pid]);
}
else if ($action == 'change_qty')
{
	$_SESSION['cart'][$pid]['qty'] = $qty;
	echo $_SESSION['cart'][$pid]['qty'];
	die;
}
else if ($action == 'checkout')
{
	$data = filter_array($_POST,'shipping!,total!,shipping_price!,coupon');
	if ($data)
	{
		$_SESSION['shipping'] = $data['shipping'];
		$_SESSION['shipping_price'] = $data['shipping_price'];
		$_SESSION['total'] = $data['total'];
		$_SESSION['coupon'] = $data['coupon'];
		echo 'ok';
	}
	else
	{
		echo 'error!';
	}
	die;
}


$view_data['title'] = 'Shopping Cart';