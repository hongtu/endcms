<?php
END_MODULE != 'admin' && die('Access Denied');

load_modules_config();

$view_data['modules'] = $end_module;


$module = $_GET['module'];
$extension = $_GET['extension'];

if ($module)
{
	get_extensions('end_'.$module);
	$view_data['page_name'] = $end_module[$module]['name'];
}
else
{
	get_extensions();
	$view_data['page_name'] = lang('all_extension');
}

$view_data['exts'] = $end_extension;

if ($extension && $end_extension[$extension])
{
	$view_data['extension'] = $end_extension[$extension];
}




function load_modules_config()
{
	global $end_module;
	$h = opendir(END_ROOT);
	while(( $v = readdir($h)) !== false)
	{
		if (!preg_match('/^end\_/i',$v)) continue;
		if (in_array($v,array('end_system','end_content'))) continue;
		$p = END_ROOT.$v;
		if (!is_dir($p)) continue;
		include_once($p.'/config.php');
	}
	closedir($h);
}


function get_extensions($path = false)
{
	global $end_module,$end_extension;
	if ($path !== false) $p = array($path);
	else
	{
		$p = array(
			'end_content',
			'end_admin',
			'end_system'
		);
		foreach($end_module as $name=>$attr)
		{
			$p[] = 'end_'.$name;
		}
	}
	$p = array_unique($p);
	foreach($p as $path)
	{
		$path = $path.'/extension';
		if (is_dir(END_ROOT.$path))
		{
			$h = opendir(END_ROOT.$path);
			while(($v = readdir($h))!==false)
			{
				if ($v == '.' || $v == '..') continue;
				if (is_dir(END_ROOT.$path.'/'.$v) && file_exists($config_file = END_ROOT.$path.'/'.$v.'/config.php'))
				{
					include_once($config_file);
					if (is_array($end_extension[$v]))
					{
						$end_extension[$v]['path'] = $path.'/'.$v.'/';
						if (!$end_extension[$v]['icon'])
						{
							$end_extension[$v]['icon'] = 'end_admin/view/default/images/default_extension_icno.png';
						}
						else
						{
							$end_extension[$v]['icon'] = $end_extension[$v]['path'].$end_extension[$v]['icon'];
						}
					}
				}
			}
		}
	}
}