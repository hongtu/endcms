<?php
/*
LoveZhi MVC
Model Prototype
by: Longbill 
created:2009-3-10
last modified:2009-4-13
*/
class END_Model extends DB
{
	var $table; // table name
	var $id;  //unique id
	var $order_id; //order column
	
	//add one row, returns the new row's id if insert succeed
	function add( $data = array())
	{
		check_allowed(str_replace(END_MYSQL_PREFIX,'',$this->table),'add',END_RESPONSE == 'text');
		$table = $data['table']?$data['table']:$this->table;
		unset($data['table']);
		$sql = $this->make_insert_sql($table,$data); 
		if ($this->query($sql))
		{
			return $this->insert_id();
		}
		else return false;
	}
	
	//delete one record by its id
	function delete($id)
	{
		check_allowed(str_replace(END_MYSQL_PREFIX,'',$this->table),'delete',END_RESPONSE == 'text');
		$sql = "DELETE FROM $this->table WHERE $this->id = '$id' LIMIT 1";
		return ($this->query($sql));
	}
	
	//check if one record exists, input an array,such as : array('name'=>'xxx','sex'=>'M')
	function exists($arr)
	{
		//$sql = $this->make_select_sql($this->table,$arr,'count(*) as total');
		$arr['select'] = 'count(1) as total';
		$r = $this->get_one($arr);
		return intval($r['total'])>0;
	}
	
	//update a row by its id
	function update( $id, $data = array())
	{
		check_allowed(str_replace(END_MYSQL_PREFIX,'',$this->table),'update',END_RESPONSE == 'text');
		$table = $data['table']?$data['table']:$this->table;
		unset($data['table']);
		$sql = $this->make_update_sql($table,$data, array($this->id => $id)); 
		return ($this->query($sql));
	}
	
	//get one row
	function get_one($id)
	{
		//check_allowed(str_replace(END_MYSQL_PREFIX,'',$this->table),'read',END_RESPONSE == 'text');
		if (is_array($id)) // if by condition
		{
			$id['total'] = '1';
			$arr = $this->get_list($id);
			return $arr[0];
		}
		else
		{
			$sql = "SELECT * FROM $this->table WHERE $this->id = '$id' LIMIT 1";
		}
		return parent::get_one($sql);
	}
	
	//get rows of one page
	function get_list($data=array())
	{
		$sql = '';
		//check_allowed(str_replace(END_MYSQL_PREFIX,'',$this->table),'read',END_RESPONSE == 'text');
		//select what
		$_select = $data['select']?$data['select']:'*';
		$_table = $data['table']?$data['table']:$this->table;
		
		//user defined conditions such as `name` LIKE '%xxx%' ....
		if ($data['where']) $sql.= " AND ".$data['where'];
		
		if ($data['total'] != 1 && $data['order'] !== false)
		{
			//order control
			if (!$data['order'] && $this->order_id)
				$sql.= " ORDER BY $this->order_id DESC";		
			else if ($data['order'])
				$sql.= " ORDER BY ".$data['order'].'';
			else 
				$sql.=" ORDER BY $this->id ";
		}
		//page control
		if ($data['from'] && $data['total'])
			$sql.=" LIMIT ".$data['from'].",".$data['total'];
		else if ($data['total'])
			$sql.=" LIMIT ".$data['total'];
		$sql.= ';';

		//unset control columns
		unset($data['select']);
		unset($data['table']);
		unset($data['where']);
		unset($data['order']);
		unset($data['total']);
		unset($data['from']);
		
		$sql = $this->make_select_sql($_table,$data,$_select).$sql;
		
		//echo $sql.'<br />';
		if ($get_one)
		{
			$sql.=" LIMIT 1";
			die;
			return $this->get_one($sql);
		}
		else
		{
			return $this->get_all($sql);
		}
	}
	
	function make_table_sql($table)
	{
		if (is_array($table))
		{
			$r = array();
			foreach($table as $alias=>$table)
			{
				$r[] = "`".END_MYSQL_PREFIX."{$table}` `$alias`";
			}
			return join(',',$r);
		}
		else return '`'.$table.'`';
	}
	
	function make_insert_sql($table,$data)
	{
		$cols = array();
		$vals = array();
		foreach($data as $key => $val)
		{
			$cols[] = $key;
			$vals[] = "'".mysql_escape_string($val)."'";
		}
		return "INSERT INTO ".$this->make_table_sql($table)." (".join(',',$cols).") VALUES(".join(',',$vals).") ";
	}
	
	function make_select_sql($table,$data = array(),$_select = '*')
	{
		$cond = array();
		foreach($data as $key => $val)
			$cond[] = "$key = '".mysql_escape_string($val)."' ";
		$sql = "SELECT $_select FROM ".$this->make_table_sql($table);
		if (count($cond) > 0)
			$sql.= " WHERE ".join(' AND ',$cond);
		else
			$sql.= " WHERE 1=1 ";
		return $sql;
	}

	function make_update_sql($table,$data,$cond_arr)
	{
		$values = array();
		$cond = array();
		foreach($data as $key => $val)
			$values[] = "$key = '".mysql_escape_string($val)."'";
		foreach($cond_arr as $key => $val)
			$cond[] = "$key = '".mysql_escape_string($val)."'";
		return "UPDATE ".$this->make_table_sql($table)." SET ".join(',',$values)." WHERE ".join(' AND ',$cond);
	}
}
?>