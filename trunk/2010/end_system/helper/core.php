<?php
/*
create a template object
*/
function template($f,$viewdir = false)
{
	global $_debug;
	$_template = new QuickSkin($f);
	$_template->set( 'reuse_code', !$_debug );
	$_template->set( 'extensions_dir', 'library/quickskin_extensions/' );
	if ($viewdir)
	{
		$_template->set( 'template_dir', $viewdir );
	}
	else
	{
		$_template->set( 'template_dir', END_VIEWER_DIR );
	}
	$_template->set( 'temp_dir', 'cache/template/' );
	$_template->set( 'cache_dir', 'cache/' );
	//$_template->set( 'cache_lifetime', 200 );
	return $_template;
}

/*
get some data arrays from a config file
*/
function config_data($f)
{
	global $view_data,$config;
	if (strpos($f,'.config') === false) $f .= '.config';
	//config file path
	$filepath = END_BASEPATH.END_VIEWER_DIR.$f;
	//cached file path
	$cfilepath = END_BASEPATH.'cache/data_config/'.$f.'.php';
	if (!file_exists($filepath))
	{
		if (file_exists($filepath.'.php'))
			$filepath .= '.php';
		else
		{
			echo '<div style="color:red">Config File ERROR:config file not found:'.$f.'</div>';
			die;
		}
	}
	//check cache file first
	if (file_exists($cfilepath) && filemtime($cfilepath) > filemtime($filepath))
	{
		include($cfilepath);
		return;
	}
	//if no cache or cache expired,then rebuild the cache file
	$lines = file($filepath);
	$vars = array();
	foreach($lines as $line)
	{
		if (preg_match('/<(\w+)\s+(\w+\s*=\s*"[^"]*"\s*)+\s*\/>/i',$line,$ms))
		{
			$varname = $ms[1];
			preg_match_all('/(\w+)="([^"]*)"/i',$line,$ms);
			$data = array();
			for($i=0;$i<count($ms[1]);$i++)
			{
				if ($ms[2][$i] !== '')
				{
					$data[$ms[1][$i]] = $ms[2][$i];
				}
			}
			$model = $data['model']?$data['model']:END_DEFAULT_CONFIG_MODEL;
			!$vars[$model] && $vars[$model] = array();
			//check if the model file exists
			if (!file_exists(END_BASEPATH.'model/'.$model.'.php'))
			{
				echo '<div style="color:red">Config File ERROR:model file not found:'.$model.'.php</div>';
				die;
			}
			unset($data['model']);
			$vars[$model][] = array('varname'=>$varname,'data'=>$data);
		}
	}
	//generate a cache file which could be included
	$s = '<'.'?php'."\n";
	$s.= '!defined("END_BASEPATH") && die("this is just a cache!");'."\n";
	foreach($vars as $model=>$arr)
	{
		$s.= 'include_once(END_BASEPATH."model/'.$model.'.php");'."\n";
		$s.= '$obj = new END_'.$model.";\n";
		foreach($arr as $_arr)
		{
			$s.= '$view_data["'.$_arr['varname'].'"] = $obj->get_list( array(';
			foreach($_arr['data'] as $key=>$val) $s.= "'$key'=>'".str_replace( array('<php>','</php>'),array("'.",".'"),addslashes($val))."',";
			$s.= ') );'."\n";
		}
	}
	$s.= '?'.'>';
	file_put_contents($cfilepath,$s)?include($cfilepath):eval($s);
}

/*
register this page to be cached
*/
function cache_this_page($t = 120)
{
	define('END_CACHE_VIEW','yes');
	define('END_CACHE_TTL',$t);
}


/*
add the second array to the first array
*/
function array_add(&$arr1,$arr2,$assoc = true)
{
	foreach($arr2 as $key=>$val)
	{
		if ($assoc)
			$arr1[$key] = $val;
		else
			$arr1[] = $val;
	}
}

/*
encode a string (usually a password)
*/
function end_encode($s)
{
	$s = md5($s).$s.'something very very very very very very very very long';
	return sha1($s);
}


/*filter an array
 	input example: md5:key1,key2,base64_encode:key3!,intval:key4
	! represents must, if it equals null then return false
	function_name:key, handle key to function_name
	key2=key1, rename key1 to key2
	
	e.g. id=intval:item_id!
*/
function filter_array($arr,$keys,$write_global = false)
{
	$re = array();
	$key_arr = explode(',',$keys);
	foreach($key_arr as $key)
	{
		$key = trim($key);
		if (!$key) continue;
		$_must = false;
		$_func = false;
		$_key = false;
		if (strpos($key,'=') !== false)
		{
			$_arr = explode('=',$key);
			$_key = $_arr[0];
			$key = $_arr[1];
		}
		if (strpos($key,'!') !== false)
		{
			$_must = true;
			$key = str_replace('!','',$key);
		}
		if (strpos($key,':') !== false)
		{
			$_arr = explode(':',$key);
			$_func = $_arr[0];
			$key = $_arr[1];
		}
		!$_key && $_key = $key;
		if ($_func && function_exists($_func))
			if (@eval('$arr[$key] = '.$_func.'($arr[$key]);') === false) return false;
		if ($_must && !$arr[$key]) 
			return false;
		else
			$re[$_key] = isset($arr[$key])?$arr[$key]:NULL;
	}
	if ($write_global)
	{
		foreach($re as $key => $val)
		{
			$GLOBALS[$key] = $val;
		}
	}
	return $re;
}

/*
load and parse language file
*/
function language($path)
{
	if (strpos($path,'.') === false) $path.= '.lang';
	$_f = END_LANGUAGE_DIR.END_LANGUAGE.'/'.$path;
	if (file_exists($_f))
	{
		$lines = file($_f);
		foreach($lines as $line)
		{
			$line = str_replace(array("\r","\n"),'',$line);
			if (preg_match('/^([a-zA-Z]{1}[a-zA-Z0-9_]*)\s*=(.*)$/',$line,$ms))
				define('LANG_'.strtoupper($ms[1]),$ms[2]);
		}
	}
}

/*
get language item
*/
function lang($key)
{
	$name = 'LANG_'.strtoupper($key);
	if (defined($name))
		return constant($name);
	else
	{
		//here do some thing log
		return $key;
	}
}
