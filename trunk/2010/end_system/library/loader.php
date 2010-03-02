<?php
class END_Loader
{
	var $loaded = array();
	
	function model($f)
	{
		$_file = END_BASEPATH.'model/'.$f;
		if (strpos($f,'.php') === false) $_file.='.php';
		if ($this->loaded['model/'.$_file]) return $this->loaded['model/'.$_file];
		if (file_exists($_file))
		{
			include_once($_file);
			if (class_exists('END_'.$f))
			{
				eval('$_obj = new END_'.$f.';');
				$this->loaded['model/'.$_file] = $_obj;
				return $_obj;
			}
			else
			{
				die("Loader Error! Class not found in file $_file");
			}
		}
		else die("Loader Error! Model file not found:$_file");
	}
	
	function helper($f)
	{
		$_file = END_BASEPATH.'helper/'.$f;
		if (strpos($f,'.php') === false) $_file.='.php';
		if ($this->loaded['helper/'.$_file]) return true;
		if (file_exists($_file))
		{
			include_once($_file);
			$this->loaded['helper/'.$_file] = true;
			return true;
		}
		else 
			die("Loader Error! Helper file not found:$_file");
	}
	
	function library($f)
	{
		$_file = END_BASEPATH.'library/'.$f;
		if (strpos($f,'.php') === false) $_file.='.php';
		if ($this->loaded['library/'.$_file]) return true;
		if (file_exists($_file))
		{
			include_once($_file);
			$this->loaded['library/'.$_file] = true;
			return true;
		}
		else 
			die("Loader Error! Library file not found:$_file");
	}
}