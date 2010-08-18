<?php

if (!$_SESSION['user']['user_id'])
{
	header('Location:?login/&return=checkout');
	die;
}

$view_data['title'] = 'Checkout step 1';