<?php

if ($_GET['id'] == '1')
{
	$data = filter_array($_POST,'email!,end_encode:password!');
	if ($data)
	{
		$user = model('user')->get_one($data);
		if ($user && $user['status'] == '1')
		{
			$view_data['msg'] = 'Your wholesale account is waiting for confirmation!';
		}
		else if ($user)
		{
			$_SESSION['user'] = $user;
			?>
			<script>
			window.location = './';
			</script>
			<?php
			die;
		}
		else
		{
			$view_data['msg'] = 'Email and password not match!';
		}
	}
	else
	{
		$view_data['msg'] = 'All fields are required!';
	}
}

$view_data['title'] = 'Sign in';