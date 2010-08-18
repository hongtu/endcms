<?php

if (!$_SESSION['user'])
{
	header('Location: ./?login');
	die;
}



if ($_POST['password'])
{
	$user = model('user')->get_one($_SESSION['user']['user_id']);

	if ($user['password'] != end_encode($_POST['password']))
	{
		$view_data['msg'] = "Your current password is wrong!";
	}
	else
	{
		model('user')->update($_SESSION['user']['user_id'],array('password'=>end_encode($_POST['new_password'])));
		?>
		<script>
		alert('You have changed your password!');
		window.location = './?account';
		</script>
		<?php
	}
}

$view_data['title'] = 'Change Password';