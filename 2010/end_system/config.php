<?php
///////////////////////////////////
//     EndCMS
// Longbill(longbill.cn@gmail.com)
//       www.endcms.com
//         @2008-2009
// under Creative Commons License
///////////////////////////////////
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

//default model name of data config entry
define('END_DEFAULT_CONFIG_MODEL','item');



define('END_UPLOAD_PATH','public/uploadfiles/');

//site language
define('END_LANGUAGE','cn');
//define directories
define('END_LANGUAGE_DIR','language/default/');
define('END_CONTROLLER_DIR','controller/default/');
define('END_VIEWER_DIR','view/default/');
define('END_VIEWER_EXT','html');

define('END_MODEL_PATH',END_TOPPATH.'end_models/');
define('END_PLUGIN_PATH',END_TOPPATH.'end_plugins/');
define('END_THEME_PATH',END_TOPPATH.'end_themes/');


//open debug mode
$_debug = 1;
if ($_debug) define('END_DEBUG','yes');

//mysql table name prefix
define('END_MYSQL_PREFIX','end_');
//mysql information
$mysql = array(
	'username' => "wap",
	'password' => "wap",
	'server' => "localhost",
	'database' => "endcms",
);

//global config ( could be overwritten by end_config entries in database ) 
$config = array(
	'mail_method'=>'smtp',
	'smtp_auth'=>true,
	'smtp_port'=>465,
	'smtp_secure'=>'ssl',
	'smtp_host'=>'smtp.gmail.com',
	'smtp_username'=>'',
	'smtp_password'=>'',
	'mail_from'=>'',
	'mail_fromname'=>''
	);

$end_models = array();

//autoload files before controller
$_preload = array(

	'library' => array(
		'mysql.php',	
		'class.quickskin.php',	//the template engine
	),

	'helper' => array(
		'common.php', 
		'html.php'
	),

	'language' => array(
		'common',	
	),

	'model' => array(
		'model.php',
		'cache.php'
	),

	'controller' => array(
		'common.php'
	),
);

$end_rights = array
(
	array(
		'name'=>'category',
		'rights'=> array('add','update','delete')
	),
	array( 
		'name'=>'item',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'account',
		'rights'=> array('update')
	),
	array(
		'name'=>'HTML',
		'rights'=>array('update')
	),
	array(
		'name'=>'config',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'guestbook',
		'rights'=> array('update','delete')
	),
	array(
		'name'=>'upload',
		'rights'=>array('add')
	),
	array(
		'name'=>'user',
		'rights'=>array('add','update','update_password','delete')
	),
	array(
		'name'=>'rights',
		'rights'=>array('add','update','delete')
	),
	array(
		'name'=>'paper',
		'rights'=>array('view','update','delete')
	)
);



/* 
other config
*/




