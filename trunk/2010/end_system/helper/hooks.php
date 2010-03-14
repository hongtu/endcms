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
	global $db,$config;
	
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
	global $view_data,$config; 
	$view_data['login_user'] = $_SESSION['login_user'];
	$view_data['now'] = array(
		'time' => date('H:i'),
		'year' => date('Y'),
		'month' => date('m'),
		'day' => date('d')
		);
	
	$r_path = dirname($_SERVER['REQUEST_URI']);
	if (!$r_path || $r_path == '/') $r_path = '.';
	$_url_base = str_replace('/./','/','http://'.$_SERVER['HTTP_HOST'].'/'.$r_path.'/');
	$view_data['url_base'] = $_url_base;
	$view_data['_get'] = $_GET;
	$view_data['_post'] = $_POST;
	$view_data['_session'] = $_SESSION;
	$view_data['config'] = $config;
	$view_data['debug'] = END_DEBUG;
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
