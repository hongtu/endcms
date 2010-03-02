<?php
class END_Item extends END_Model
{
	function END_Item()
	{
		$this->table = END_MYSQL_PREFIX.'item';
		$this->order_id = 'order_id';
		$this->id = 'item_id';
		$this->columns = array('item_id','category_id','update_time',
		'create_time','user_id','name','description',
		'view_count','order_id','keywords','has_pic','pic_url','status');
	}
	
	function add($data=array())
	{
		check_allowed_category($data['category_id'],END_RESPONSE == 'text');
		return parent::add($data);
	}
	
	function delete($id)
	{
		$this_item = $this->get_one($id);
		check_allowed_category($this_item['category_id'],END_RESPONSE == 'text');
		return parent::delete($id);
	}

	function update($id,$data = array())
	{
		$this_item = $this->get_one($id);
		check_allowed_category($this_item['category_id'],END_RESPONSE == 'text');
		if ($data['category_id']) check_allowed_category($data['category_id'],END_RESPONSE == 'text');
		return parent::update($id,$data);
	}
	
	function get_extend($status,$id)
	{
		$_table = $this->table;
		$this->table = END_MYSQL_PREFIX.'item_'.$status;
		$re = $this->get_one($id);
		$this->table = $_table;
		return $re;
	}
	
	function get_asso($status,$id)
	{
		$sql = "SELECT * FROM $this->table a,".END_MYSQL_PREFIX."item_{$status} b WHERE a.item_id=b.item_id AND a.item_id='$id' LIMIT 1";
		$r = $this->query($sql);
		return $this->fetch_array($r);
	}
	
	function add_view_count($id)
	{
		global $db;
		return $db->query("UPDATE $this->table SET view_count=view_count+1 WHERE $this->id='$id' LIMIT 1");
	}
	
	function get_list($data=array())
	{
		if ($data['category_id'] == 0) unset($data['category_id']);
		!$data['where'] && $data['where'] = ' 1=1 ';
		if (isset($data['status']) && $data['status'] !== false)
		{
			
			$data['where'] .= " AND status IN ($data[status]) ";
			unset($data['status']);
		}
		else if ($data['status'] !== false)
			$data['status'] = '1';
		else if ($data['status'] === false)
			unset($data['status']);
			
		if ($data['with_children_category'])
		{
			include_once(END_BASEPATH.'/model/category.php');
			if ($data['category_id'])
			{
				$category = new END_Category;
				$tree = $category->tree_category($data['category_id']);
				$arr = array();
				$category->flat_tree($tree,$arr);
				$ids = array();
				foreach($arr as $_arr) $ids[] = $_arr['category_id'];
				if (!$data['only_children_category'])
					$ids[] = $data['category_id'];
				else
					unset($data['only_children_category']);
				if ($data['where']) $data['where'].= ' AND ';
				$data['where'] .= ' category_id IN ('.join(',',$ids).')';
			}
			unset($data['with_children_category']);
			unset($data['category_id']);
		}
		
		if (END_MODULE == 'admin' && $_SESSION['login_user']['rights']['limit_category_id'] && $_SESSION['login_user']['allowed_categories'])
		{
			$data['where'] && $data['where'] .= ' AND ';
			$data['where'] .= 'category_id IN ('.$_SESSION['login_user']['allowed_categories'].')';
		}
		!$data['order'] && $data['order'] = "order_id DESC,create_time DESC";
		if ($data['with_table'])
		{
			$data['table'] = array('a'=>'item','b'=>$data['with_table']);
			unset($data['with_table']);
			foreach($data as $__key => $__val)
			{
				if (in_array($__key,array('select','table','from','total','where','order'))) continue;
				if (!in_array($__key,$this->columns))
				{
					unset($data[$__key]);
					$data['b.'.$__key] = $__val;
				}
			}
			foreach($this->columns as $_col)
			{
				$data['where'] = preg_replace('/\b'.$_col.'\b/i',' a.'.$_col.' ',$data['where']);
				$data['order'] = preg_replace('/\b'.$_col.'\b/i',' a.'.$_col.' ',$data['order']);
				foreach($data as $__key => $__val)
				{
					if ($__key == $_col)
					{
						unset($data[$__key]);
						$data['a.'.$_col] = $__val;
					}
				}
			}
			$data['where'].=' AND a.item_id=b.item_id';
		}
		return parent::get_list($data);
	}
}
?>