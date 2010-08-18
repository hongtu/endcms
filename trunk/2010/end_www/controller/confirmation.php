<?php

if (!$_SESSION['user']['user_id'])
{
	header('Location:?login');
	die;
}

$_SESSION['billing_information'] = $view_data['billing'] = $_POST['billing'];
$_SESSION['shipping_information'] = $view_data['shipping'] = $_POST['shipping'];

$view_data['title'] = 'Checkout confirmation';