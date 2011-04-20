<?php
class MODEL_CONFIG
{
	function MODEL_CONFIG()
	{
		$this->table = END_ROOT.'end_system/site_config.php';
	}
	
	public static function get($name)
	{
		return $GLOBALS['config'][$name];
	}
	
	public static function get_list()
	{
		return $GLOBALS['site_config'];
	}
	
	function update($id,$data)
	{
		$id--;
		foreach($data as $k=>$v)
		{
			$GLOBALS['site_config'][$id][$k] = $v;
		}
		return MODEL_CONFIG::write_config_file();
	}
	public static function write_config_file()
	{
		$s = "<"."?php\nreturn ".var_export($GLOBALS['site_config'],true).';';
		return file_put_contents(END_SYSTEM_DIR.'site_config.php',$s);
	}
	
	function get_one($id)
	{
		return $GLOBALS['site_config'][$id-1];
	}
	
	function delete($id)
	{
		$id--;
		$n = array();
		foreach($GLOBALS['site_config'] as $_id=>$arr)
		{
			if ($_id != $id) $n[] = $arr;
		}
		$GLOBALS['site_config'] = $n;
		return MODEL_CONFIG::write_config_file();
	}
	
	function add($data)
	{
		$GLOBALS['site_config'][] = $data;
		return MODEL_CONFIG::write_config_file();
	}
}
?>