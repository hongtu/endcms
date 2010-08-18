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


$view_data['title'] = 'Shopping Cart';