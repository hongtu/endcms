<?php
class END_Category extends END_Model
{
	function END_Category()
	{
		$this->table = END_MYSQL_PREFIX.'category';
		$this->order_id = 'order_id';
		$this->id = 'category_id';
	}

	function delete($id)
	{
		global $cache;
		check_allowed_category($id,END_RESPONSE == 'text');
		$re = parent::delete($id);
		$cache->clear_uri('#admin/category');
		return $re;
	}
	
	function add($data)
	{
		global $cache;
		$re = parent::add($data);
		$cache->clear_uri('#admin/category');
		return $re;
	}

	function update($id,$data)
	{
		global $cache;
		check_allowed_category($id,END_RESPONSE == 'text');
		if ($data['status'])
		{
			$data['list'] = (preg_match('/_list$/',$data['status']))?'1':'0';
		}
		$re = parent::update($id,$data);
		$cache->clear_uri('#admin/category');
		return $re;
	}

	function position_category($id)
	{
		global $db;
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
				{
					$re[] = $arr;
				}
			}
			else
			{
				$re[] = $arr;
			}
			$cond[$this->id] = $arr['parent_id'];
		}
		$re = array_reverse($re);
		return $re;
	}
	
	function tree_category($parent_id = 0,$status = false)
	{
		global $cache;
		$cache_uri = '#admin/category/'.$_SESSION['login_user']['user_id'].'/'.$parent_id.'/'.$status;
		/*
		if ($cache->exists($cache_uri))
		{
			$s = '$re = '.$cache->get($cache_uri,$ttl).';';
			eval($s);
			return $re;
		}
		*/
		$re = $this->_tree_category($parent_id,0,$status);
		//$cache->add(array('content'=>var_export($re,1),'uri'=>$cache_uri,'ttl'=>30000000));
		return $re;
	}
	
	function _tree_category($parent_id = 0,$depth = 0, $status = false)
	{
		//check_allowed_category($parent_id,END_RESPONSE == 'text');
		$re = array();
		$with_children = true;
		$data = array(
			//'select'=>'order_id,longname,parent_id,url,category_id,name,description,status'
			);
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
			//$c['depth'] = $depth;
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