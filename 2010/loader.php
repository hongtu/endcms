<?php
error_reporting(E_ALL);
define("WEBROOT", realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
//system root
define("SYSROOT", realpath(WEBROOT.'../system/').DIRECTORY_SEPARATOR);
//require context helper
require(SYSROOT."utils".DIRECTORY_SEPARATOR.'Context.class.php');
//use context to register something: include_path, autoload and config
$config = require(WEBROOT.'config.php');
Context::register($config);
$db = Database::getInstance();