<?php

function end_on_begin()
{
	if (END_MODULE == 'admin')
	{
		include_once(END_BASEPATH.'helper/admin_functions.php');
	}
}


function end_on_after_db()
{
	global $db,$_time_start,$config,$cache,$loader;
	
	//get config from database
	if (!is_array($config)) $config = array();
	$r = $db->get_all("SELECT * FROM `".END_MYSQL_PREFIX."config`");
	foreach($r as $arr)
	{
		$arr['name'] && $config[$arr['name']] = $arr['value'];
	}
}


function end_on_ready()
{
	global $loader;
	if (END_MODULE == 'admin' && $_GET['p'] != 'login')
	{
		if (!$_SESSION['login_user'])
		{
			header("location:admin.php?p=login&module=admin&backurl="
				.urlencode(basename($_SERVER['SCRIPT_NAME']).'?'.$_SERVER['QUERY_STRING']));
			die;
		}
		$rights = model('rights');
		$r = $rights->get_one($_SESSION['login_user']['rights_id']);
		unset($_SESSION['login_user']['rights']);
		unset($_SESSION['login_user']['allowed_controllers']);
		unset($_SESSION['login_user']['allowed_categories']);
		if ($r && $r['rights'])
		{
			$arr = explode(',',$r['rights']);
			$allowed_categories = array();
			foreach($arr as $val)
			{
				$_SESSION['login_user']['rights'][$val] = true;
				if (preg_match('/^category_\d/i',$val))
				{
					$val = preg_replace('/^category_/i','',$val);
 					$allowed_categories[] = $val;
				}
				$val = preg_replace('/_[^\_]+$/i','',$val);
				$_SESSION['login_user']['allowed_controllers'][$val] = true;
			}
			$_SESSION['login_user']['allowed_categories'] = join(',',$allowed_categories);
		}
	}
}


function end_on_template_begin()
{
	global $all_view_data; 
	$all_view_data['login_user'] = $_SESSION['login_user'];
	$all_view_data['now'] = array(
		'time' => date('H:i'),
		'year' => date('Y'),
		'month' => date('m'),
		'day' => date('d')
		);
}

function end_on_end()
{
	global $view_html,$end_make_html_path,$end_make_html_status,$end_all_time_used;
	if ($end_make_html_path)
	{
		end_mkdir(dirname($end_make_html_path));
		$end_make_html_status = file_put_contents($end_make_html_path,$view_html);
		$end_all_time_used += $end_time_used;
	}
	else
		echo $view_html;
}
