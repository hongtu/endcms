<?php
END_MODULE != 'admin' && die('Access Denied');

$user_id = intval($_GET['user_id']);
$m = $_GET['m'];
$action = $_GET['action'];
$status = $_GET['status'];
$user = model('user');


//状态处理
$statuses = array();
if (is_array($user->status))
{
	foreach($user->status as $val) $statuses[$val['id']] = array('index'=>$val['id'],'value'=>$val['name']);
}
$view_data['statuses'] = $statuses;
$view_data['current_status_all'] = isset($_GET['status'])?false:true;
$view_data['status'] = $view_data['current_status_all']?'-1':$status;


function show_status($s)
{
	global $statuses;
	return $statuses[$s]?$statuses[$s]['value']:lang('UNKNOWN');
}

if ($m == 'new_user')
{
	check_allowed('user','add');
	$data = filter_array($_POST,'name!,end_encode:password!,email');
	if ($user->exists($data['name']))
	{
		end_exit(lang("USER_EXISTS"),'user.php?p=user',1);
	}
	else if ( $user->add($data) )
	{
		end_exit(lang('USER_NEW_SUCCESS'),'user.php?p=user',1);
	}
	else
	{
		$err_msg = lang('USER_NEW_ERROR');
		$action = 'new_user';
	}
}
else if ($m == 'edit_user')
{
	check_allowed('user','update');
	$_user = $user->get_one($user_id);
	$data = array('user_id'=>$user_id);
	$errors = array();
	$_fields = $end_user_config;
	
	//处理提交的数据
	include('edit_field.php');
	//提交数居后的处理
	if ($_fields['__after_edit']) $_fields['__after_edit']($data);

	if (count($data)>0 && count($errors) == 0)
	{
		$re = $user->update( $user_id, $data);
		if ( $re )
		{ 
			//写入数据库后
			if ($_fields['__after_db']) $_fields['__after_db']($item->get_one($item_id));
			
			$return_to = $_SESSION['backurl']?$_SESSION['backurl']:'admin.php?p=user';
			end_exit(lang('USER_EDIT_SUCCESS'),$return_to,1);
		}
		else
		{
			$action = 'edit_user';
			$err_msg = lang('UPDATE_FAILED');
		}
	}
	else
	{
		$action = 'edit_user';
		//生成错误提示信息
		$err_msg = array();
		foreach($errors as $key=>$err)
		{
			$err_msg[] = $_fields[$key]['name'].' '.$err;
		}
		$err_msg = join('<br />',$err_msg);
	}
}



if ($action == 'edit_user')
{
	$_SESSION['backurl'] = ($_GET['backurl'])?$_GET['backurl']:$_SERVER['HTTP_REFERER'];
	if (!$user_id)
	{
		end_exit("need user_id!",'javascript:history.go(-1)',5);
	}
	$_user = $user->get_one($user_id);
	
	$temp = template('user_edit.html');
	if (count($data)>0)
	{
		$__user = $data;
	}
	else
	{
		$__user = $_user;
	}
	$temp->assign($view_data);
	$temp->assign( array(
		'content' => $__user,
		'err_msg' => $err_msg,
		'fields'=>$end_user_config,
		'user_id' => $user_id,
		'login_user' => $_SESSION['login_user'],
	));
	$view_data['page_description'] = lang('EDIT_CATEGORY');
	$view_data['page_content'] = $temp->result();
}


$view_data['page_description'] = lang('USER_INDEX');
$view_data['err_msg'] = $err_msg;
$view_data['user_id'] = $user_id;



$cond = array();

if ($_GET['order'] && $_GET['asc'])
	$cond['order'] = $_GET['order'].' asc';
else if ($_GET['order'])
	$cond['order'] = $_GET['order'].' desc';

//搜索控制
if (isset($status)) $cond['status'] = $status;
$cond['where'] = ' 1=1 ';
if ($_GET['from']) $cond['where'].= " AND created_at>='".mysql_escape_string($_GET['from'])."'";
if ($_GET['to']) $cond['where'].= " AND created_at<='".mysql_escape_string($_GET['to'])."'";
if ($_GET['search_username']) $cond['where'].=" AND username LIKE '%".mysql_escape_string($_GET['search_username'])."%'";
if ($_GET['search_email']) $cond['where'].=" AND email LIKE '%".mysql_escape_string($_GET['search_email'])."%'";
$view_data['from'] = $_GET['from'];
$view_data['to'] = $_GET['to'];
$view_data['search_email'] = $_GET['search_email'];
$view_data['search_username'] = $_GET['search_username'];

//分页控制
$users = end_page($user,$cond,(intval($config['admin_user_page_size']))?intval($config['admin_user_page_size']):20);
$view_data['users'] = $users;


