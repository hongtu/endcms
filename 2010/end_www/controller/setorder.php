<?php


if (!$_SESSION['user']['user_id'])
{
	header('Location:?login');
	die;
}

if (!$_SESSION['cart'] || count($_SESSION['cart']) == 0)
{
	header('Location:./');
	die;
}

$data = array();

$b = $_SESSION['billing_information'];
$data['billing'] = $b['fname'].' '.$b['lname'].'<br />'.$b['street'].'<br />'.$b['city'].', '.$b['states'].' '.$b['zip'];

$b = $_SESSION['shipping_information'];
$data['shipping'] = $b['fname'].' '.$b['lname'].'<br />'.$b['street'].'<br />'.$b['city'].', '.$b['states'].' '.$b['zip'];

$data['shipping_price'] = $_SESSION['shipping_price'];
$data['ship_method'] = $_SESSION['shipping'];
$data['total'] = $_SESSION['total'];

$data['product_ids'] = array();
foreach($_SESSION['cart'] as $pid => $p)
{
	if ($p['qty'] > 0)
	{
		$data['product_ids'][] = $pid.'='.$p['qty'];
	}
}
$data['product_ids'] = join(',',$data['product_ids']);
$data['create_time'] = time();
$data['name'] = $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];
$data['email'] = $_SESSION['user']['email'];
$data['user_id'] = $_SESSION['user']['user_id'];

if (model('order')->add($data))
{
	$_SESSION['cart'] = array();
	echo 'done!';
}
else
{
	echo 'error!';
}

die;