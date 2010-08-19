<?php

$tax = 1;
$domain = $_SERVER['HTTP_HOST'];
$paypal_account = 'sales@'.$domain;


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
$subtotal = 0;
foreach($_SESSION['cart'] as $pid => $p)
{
	if ($p['qty'] > 0)
	{
		$data['product_ids'][] = $pid.'='.$p['qty'];
		$price = ($_SESSION['user']['status'] == 2)?$p['wholesale']:$p['retail'];
		$subtotal += $price*$p['qty'];
	}
}
$data['product_ids'] = join(',',$data['product_ids']);
$data['create_time'] = time();
$data['name'] = $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];
$data['email'] = $_SESSION['user']['email'];
$data['user_id'] = $_SESSION['user']['user_id'];


if ($_POST['coupon'] != '')
{
	$c = model('coupon')->get_one(array('name'=>$_POST['coupon']));
	if ($c)
	{
		$shipping = $_SESSION['shipping_price'];
		$total = $_SESSION['total'];
		$data['coupon_price'] = model('coupon')->get_price($_POST['coupon'],$subtotal,$shipping,$total);
		$data['total'] -= $data['coupon_price'];
		$data['coupon'] = $_POST['coupon'];
		if ($data['total'] <= 0 ) $data['total'] = 0;
	}
}
if (!$data['coupon_price']) $data['coupon_price'] = 0;





if (model('order')->add($data))
{

	$payment_method = '';
	$i=0;
	foreach($_SESSION['cart'] as $cart_row)
	{
		$i++;
		$unit_price = ($_SESSION['user']['status'] == 2)?$cart_row['wholesale']:$cart_row['retail'];
		$product_name = urlencode($cart_row['name']);
		$qty = $cart_row['qty'];
		$final_price = $unit_price*$qty;
		$payment_method .= "&item_name_{$i}={$product_name}"
			."&quantity_{$i}={$qty}"
			."&amount_{$i}={$unit_price}";
	}
	$i++;
	$payment_method .= "&item_name_{$i}=Tax&quantity_{$i}=1&amount_{$i}={$tax}";
	$i++;
	$payment_method .= "&item_name_{$i}=Shipping Method&quantity_{$i}=1&amount_{$i}=".$_SESSION['shipping_price'];

	if ($data['coupon_price'] > 0)
	{
		$i++;
		$payment_method .= "&discount_amount_cart=".$data['coupon_price'];
	}
	
	$links = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart&upload=1&business={$paypal_account}&currency_code=USD"
	."&cancel_return=http://{$domain}&return=http://{$domain}"
	."&email=".$_SESSION['user']['email']
	."&first_name=".$_SESSION['user']['fname']
	."&last_name=".$_SESSION['user']['lname']
	."&address1=".$_SESSION['user']['street']
	."&city=".$_SESSION['user']['city']
	."&zip=".$_SESSION['user']['city']
	.$payment_method;
	
	$_SESSION['cart'] = array();
	$view_data['paypal'] = $links;
	$view_data['title'] = 'Pay';
}
else
{
	echo 'error!';
	die;
}

