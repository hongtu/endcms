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
define('END_SYSTEM_DIR',$_system_folder.'/');
define('END_ROOT',preg_replace('/\/end_system\/?$/','/',$_system_folder));
define('END_MODULE_DIR',END_ROOT.'end_'.END_MODULE.'/');
//基础函数
include_once(END_SYSTEM_DIR.'helper/core.php');
//钩子函数
helper('hooks');
//处理输出相关函数
helper('html');

function_exists('end_on_begin') && end_on_begin();

define('END_ENABLE_LANGUAGE',false);
include_once(END_SYSTEM_DIR.'config.php');
include_once(END_SYSTEM_DIR.'library/mysql.php');
include_once(END_SYSTEM_DIR.'library/model.php');

//载入对应模块的config.php
if (END_MODULE != 'index' && file_exists(END_MODULE_DIR.'config.php')) include_once(END_MODULE_DIR.'config.php');

//连接数据库
$db = new DB;
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

language('common');
language($_page);

//common scripts
include_once(END_SYSTEM_DIR.'common.php');
//hook
function_exists('end_on_ready') && end_on_ready();

//the ultimate view data array
$view_data = array();
$view_html = '';

//load the main controller
$_c_filename = END_CONTROLLER_DIR.$_controller;
file_exists($_c_filename) && include($_c_filename);

if (!$view_html)
{
	$_viewer_dir = END_VIEWER_DIR;
	function_exists('end_on_template_begin') && end_on_template_begin();
	$_template = template($_viewer);
	//total output array by controllers
	$_template->assign($view_data);
	
	//timer stop
	list($_usec, $_sec) = explode(' ', microtime()); 
	$_time_end = (float)$_usec + (float)$_sec;
	
	$end_time_used = intval(($_time_end-$_time_start)*1000)/1000;
	$_template->assign('time_used',$end_time_used);
	$_template->assign('total_query',$db->query_num);
	
	$view_html = $_template->result();
	unset($_template);
}
if (function_exists('end_on_end'))
	end_on_end();
else
{
	echo end_gzip($view_html);
	die;
}
?>