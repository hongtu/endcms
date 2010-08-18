<?php


if ($_POST && $_POST['email'])
{
	$data = filter_array($_POST,'fname!,lname!,city,states,zip,phone,fax,street');
	if ($data)
	{	
		if ($data && model('user')->update($_SESSION['user']['user_id'],$data))
		{
			$_SESSION['user'] = model('user')->get_one($_SESSION['user']['user_id']);
			echo '<script>';
			echo 'alert("Your profile has been changed!");';
			echo 'window.location = "./?account";';
			echo '</script>';
			die;
		}
	}
	else
	{
		$view_data['msg'] = 'All fields are required!';
	}
}

$view_data['title'] = 'My profile';