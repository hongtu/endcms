<?php
/**********************************
*     		EndCMS
*       www.endcms.com
*         ©2008-now
* under Creative Commons License
**********************************/

/*
./config.php:
  system configuration
*/


//site charset
define('END_CHARSET','UTF-8');

//view page cache
!defined('END_CACHE_VIEW') && define('END_CACHE_VIEW',true);

//allowed upload file types, separated by comma
define('END_UPLOAD_FILE_TYPES',',jpg,jpeg,gif,bmp,png,doc,rar,pdf,zip,ppt,docx,xls,');

define('END_UPLOAD_DIR','public/'.date('Y/m/'));

//site language
define('END_LANGUAGE','cn');
//define directories
define('END_LANGUAGE_DIR',END_MODULE_DIR.'language/');
define('END_CONTROLLER_DIR',END_MODULE_DIR.'controller/');
define('END_VIEWER_EXT','html');

define('END_MODEL_DIR',END_ROOT.'end_'.END_MODULE.'/model/');
define('END_PLUGIN_DIR',END_ROOT.'end_'.END_MODULE.'/plugin/');
define('END_THEME_DIR',END_ROOT.'end_'.END_MODULE.'/view/');




//open debug mode
define('END_DEBUG',true);

//mysql table name prefix
define('END_MYSQL_PREFIX','end_');
//mysql information
$mysql = array(
	'username' => "endcms",
	'password' => "2012",
	'server' => "localhost",
	'database' => "endcms",
);

//global config ( could be overwritten by end_config entries in database ) 
$config = array();





