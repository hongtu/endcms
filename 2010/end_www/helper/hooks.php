<?php
function end_on_begin()
{
	$arr = explode('/',array_shift(explode('&',$_SERVER['QUERY_STRING'])));
	if ($arr[0] && !$_GET['p']) $_GET['p'] = $arr[0];
	if ($arr[1] && !$_GET['id']) $_GET['id'] = $arr[1];
	if ($arr[2] && !$_GET['q']) $_GET['q'] = $arr[2];
}

function end_on_after_db()
{
	global $db,$config;
	
	//get config from database
	if (!is_array($config)) $config = array();
	$r = $db->get_all("SELECT `name`,`value` FROM `".END_MYSQL_PREFIX."config`");
	foreach($r as $arr)
	{
		$arr['name'] && $config[$arr['name']] = $arr['value'];
	}
}

function end_on_ready()
{
	
}

function end_on_template_begin()
{
	global $view_data,$config; 
	$view_data['login_user'] = $_SESSION['login_user'];
	
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
