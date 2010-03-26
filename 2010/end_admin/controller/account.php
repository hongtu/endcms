<?php
END_MODULE != 'admin' && die('Access Denied');
define('END_RESPONSE','text');
$m = $_GET['m'];
$admin = model('admin');

if ($m == 'edit')
{
	check_allowed('account','update',1);
	$data = filter_array($_POST,'email');
	if ($_POST['password']) $data['password'] = end_encode($_POST['password']);

	if ($data && $admin->update($_SESSION['login_user']['admin_id'],$data))
	{
		$_SESSION['login_user'] = $admin->get_one($_SESSION['login_user']['admin_id']);
		echo lang('admin_UPDATE_SUCCESS');
		die;
	}
	else
	{
		echo  lang('admin_UPDATE_ERR');
		die;
	}
}
else if ($m == 'get_admin')
{
	$arr = $admin->get_one($_SESSION['login_user']['admin_id']);
	echo json_encode($arr);
	die;
}

$view_data['admin'] = $admin->get_one($_SESSION['login_user']['admin_id']);
$view_data['page_description'] = lang('MY_ACCOUNT');
