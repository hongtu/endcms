<?php
class MODEL_CATEGORY extends MODEL
{
	function MODEL_CATEGORY()
	{
		$this->table = END_MYSQL_PREFIX.'category';
		$this->order_id = 'order_id';
		$this->id = 'category_id';
	}

	function delete($id)
	{
		check_allowed_category($id,END_RESPONSE == 'text');
		return parent::delete($id);
	}
	
	function add($data)
	{
		if ($data['parent_id'])
		{
			check_allowed_category($data['parent_id'],END_RESPONSE == 'text');
		}
		$re = parent::add($data);
		if (!$data['create_time']) $data['create_time'] = time();
		return $re;
	}

	function update($id,$data)
	{
		check_allowed_category($id,END_RESPONSE == 'text');
		if (!$data['update_time']) $data['update_time'] = time();
		return parent::update($id,$data);
	}

	function position_category($id)
	{
		$cond = is_array($id)?$id:array($this->id=>$id); 
		$re = array();
		while($cond[$this->id])
		{
			$arr = $this->get_one($cond);
			if (!$arr || (is_array($arr) && count($arr)==0)) break;
			$id = $arr['category_id'];
			if (END_MODULE == 'admin' && $_SESSION['login_user']['rights']['limit_category_id'] && $_SESSION['login_user']['allowed_categories'])
			{
				if (strpos(','.$_SESSION['login_user']['allowed_categories'].',',','.$id.',') !== false)
					$re[] = $arr;
			}
			else
				$re[] = $arr;
			$cond[$this->id] = $arr['parent_id'];
		}
		$re = array_reverse($re);
		return $re;
	}
	
	function tree_category($parent_id = 0,$status = false)
	{
		$re = $this->_tree_category($parent_id,0,$status);
		return $re;
	}
	
	function _tree_category($parent_id = 0,$depth = 0, $status = false)
	{
		$re = array();
		$with_children = true;
		$data = array();
		if (END_MODULE == 'admin' && $_SESSION['login_user']['rights']['limit_category_id'] && $_SESSION['login_user']['allowed_categories'])
		{
			$data['where'] = 'category_id IN ('.$_SESSION['login_user']['allowed_categories'].')';
			if ($status !== false)	$data['status'] = $status;
			$arr = $this->get_list($data);
			$with_children = false;
		}
		else
		{
			$data['parent_id'] = $parent_id;
			if ($status !== false)	$data['status'] = $status;
			$arr = $this->get_list( $data);
		}
		
		for($i=0;$i<count($arr);$i++)
		{
			$arr[$i]['depth'] = $depth;
			$re[$arr[$i]['category_id']] = $arr[$i];
			if ($with_children) $re[$arr[$i]['category_id']]['children'] = $this->_tree_category($arr[$i]['category_id'],$depth+1,$status);
		}
		return $re;
	}

	function flat_tree($tree,&$re = array())
	{
		foreach($tree as $c)
		{
			$re[] = $c;
			$re[count($re)-1]['children'] = null;
			if (count($c['children'])>0) $this->flat_tree($c['children'],$re);
		}
	}
	
	function get_list($data=array())
	{
		if (END_MODULE == 'admin' && $_SESSION['login_user']['rights']['limit_category_id'] && $_SESSION['login_user']['allowed_categories'])
		{
			$data['where'] && $data['where'] .= ' AND ';
			$data['where'] .= 'category_id IN ('.$_SESSION['login_user']['allowed_categories'].')';
		}
		return parent::get_list($data);
	}
}
?>