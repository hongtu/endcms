<?php
END_MODULE != 'admin' && die('Access Denied');

$program_id = intval($_GET['program_id']);
$action = $_GET['action'];

if (!$program_id)
{
	die('need program_id');
}

$announce = new Programannounce;



if ($action == 'add')
{
	check_allowed('programannounce','add');
	$content = $_POST['content'];
	if ($content)
	{
		if ($announce->add(array(
			'program_id'=>$program_id,
			'user_id'=>$_SESSION['login_user']['admin_id'],
			'content'=>$content
			)))
		{
			end_exit("添加成功！",'admin.php?p=programannounce&program_id='.$program_id,1);
		}
		else
			end_exit("添加失败！",'admin.php?p=programannounce&program_id='.$program_id,3);
	}
}


$program = new Program;
$view_data['program'] = $program->get_one($program_id);



$announces = end_page($announce,array('program_id'=>$program_id),20);

$view_data['announces'] = $announces;
$view_data['program_id'] = $program_id;