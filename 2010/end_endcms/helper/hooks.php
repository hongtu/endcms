<?php
function end_on_begin()
{
	helper('common');
}

function end_on_after_db()
{
	
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
