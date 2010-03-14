<?php
/**********************************
*     		EndCMS
*       www.endcms.com
*         ©2008-now
* under Creative Commons License
**********************************/

/**
 * MVC核心处理过程
 * @author Longbill
 * 2010-03-13
 */

//页面执行时间计时开始
error_reporting(E_ALL ^ E_NOTICE);
list($_usec, $_sec) = explode(' ', microtime()); 
$_time_start = (float)$_usec + (float)$_sec;


//获得并设置系统执行的路径
$_system_folder = dirname(__FILE__);
$_system_folder = str_replace("\\", "/", $_system_folder);
define('END_BASEPATH',$_system_folder.'/');
define('END_TOPPATH',preg_replace('/\/end_system\/?$/','/',$_system_folder));

//基础函数
include_once(END_BASEPATH.'helper/core.php');
//钩子函数
include_once(END_BASEPATH.'helper/hooks.php');

function_exists('end_on_begin') && end_on_begin();

if (!defined('END_MODULE')) define('END_MODULE','index');
include_once(END_BASEPATH.'config.php');
include_once(END_BASEPATH.'library/mysql.php');

//connect to database
!$db && $db = new DB();
$db->connect($mysql['server'],$mysql['username'],$mysql['password'],$mysql['database']);

//hook
function_exists('end_on_after_db') && end_on_after_db();

header("CONTENT-TYPE:text/html; CHARSET=".END_CHARSET);


//get main controller
$_page = ($_GET['p'])?$_GET['p']:'index';
$_page = preg_replace('/[^a-zA-Z0-9_]/','',$_page);
define('END_CONTROLLER',$_page);
$_controller = $_page.'.php';

$_viewer = $_page.'.'.END_VIEWER_EXT;

//auto load language file which has the same name as the main controller
$_language_dir = END_LANGUAGE_DIR.END_LANGUAGE.'/';
$_preload['language'][] = $_page;

//load files defined in $_preload
foreach($_preload as $_fpath => $_files)
{
	if ($_fpath == 'controller') continue;
	foreach($_files as $_fname)
	{
		$_filename = $_fpath.'/'.$_fname;
		if ($_fpath == 'language')
			language($_fname);
		else
			file_exists($_filename) && include_once($_filename);
	}
}


//common scripts
include_once('common.php');

//hook
function_exists('end_on_ready') && end_on_ready();

//the ultimate view data array
//every controller should push its data in the $view_data array
$all_view_data = array();
$view_data = array();
$view_html = '';

//autoload controllers specified in $_preload
foreach($_preload['controller'] as $_fname)
{
	$_filename = END_CONTROLLER_DIR.$_fname;
	if (file_exists($_filename))
	{
		include_once($_filename);
		if(is_array($view_data))
		{
			array_add($all_view_data,$view_data);
			unset($view_data);
		}
	}
}

//load config file
$_c_config = END_BASEPATH.'config/'.$_controller;
file_exists($_c_config) && include_once($_c_config);

//load the main controller
$_c_filename = END_CONTROLLER_DIR.$_controller;
file_exists($_c_filename) && include($_c_filename);
if(is_array($view_data))
{
	array_add($all_view_data,$view_data);
	unset($view_data);
}

//if $view_html is not setted , use template engine to parse $all_view_data
if (!$view_html)
{
	$_viewer_dir = END_VIEWER_DIR;
	function_exists('end_on_template_begin') && end_on_template_begin();
	$_template = template($_viewer);
	//total output array by controllers
	$_template->assign($all_view_data);
	$r_path = dirname($_SERVER['REQUEST_URI']);
	$_template->assign('viewroot','end_system/'.$_viewer_dir);
	if (!$r_path || $r_path == '/') $r_path = '.';
	$_url_base = str_replace('/./','/','http://'.$_SERVER['HTTP_HOST'].'/'.$r_path.'/');
	$_template->assign('url_base',$_url_base);
	$_template->assign('config',$config);
	$_template->assign('debug',$_debug);
	$_template->assign('_get',$_GET);
	$_template->assign('_post',$_POST);
	$_template->assign('_session',$_SESSION);
	
	//timer stop
	list($_usec, $_sec) = explode(' ', microtime()); 
	$_time_end = (float)$_usec + (float)$_sec;
	$end_time_used = intval(($_time_end-$_time_start)*1000)/1000;
	$_template->assign('time_used',$end_time_used);

	$_template->assign('total_query',$db->query_num);
	$view_html = $_template->result();
	unset($_template);
}
function_exists('end_on_end')?end_on_end():die($view_html);
?>