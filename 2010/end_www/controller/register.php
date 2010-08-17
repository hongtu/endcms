<?php


if ($_GET['id'] == '1')
{
	$data = filter_array($_POST,'email!,end_encode:password!');
	if ($data)
	{
		$data['status'] = ($_POST['type'] == 'wholesale')?'1':'0';
		$data['create_time'] = time();
		
		if (model('user')->exists(array('email'=>$data['email'])))
		{
			$view_data['msg'] = 'This email has been used!';
			$data = false;
		}
		
		
		
		
		if ($data && model('user')->add($data))
		{
			echo '<script>';
			if ($_POST['type'] == 'wholesale')
			{
				echo 'alert("Your wholesale account is waiting for confirmation!");';
			}
			else
			{
				$_SESSION['user'] = $data;
				echo 'alert("Success");';
			}
			echo 'window.location = "./";';
			echo '</script>';
			die;
		}
	}
	else
	{
		$view_data['msg'] = 'All fields are required!';
	}
}

$view_data['title'] = 'Register an Account';