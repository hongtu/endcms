<?php
//入口验证
END_MODULE != 'admin' && die('Access Denied');
//过滤数据，并写入全局变量
filter_array($_GET,'m,action,intval:item_id,intval:category_id,status',true);

load_models();

$category = model('category');
$err_msg = '';
$success_msg = '';
/* 必须传入 category_id*/
if ($category_id)
{
	$this_category = $category->get_one($category_id);
	if (preg_match('/_list$/i',$this_category['status']))
	{
		/*内容类型*/
		$item_type = preg_replace('/_list$/i','',$this_category['status']);
		$item = model($item_type);
		$_fields = $end_models[$item_type.'_list']['fields'];

		define('ITEM_TYPE',$item_type);
		if ($m == 'edit_item')
			check_allowed($item_type,'update');
		else if ($m == 'new_item')
			check_allowed($item_type,'add');
		
		//添加或者修改，提交处理部分
		if ($m == 'edit_item' || $m == 'new_item')
		{
			$data = array();
			if ($item_id) $data[$item->id] = $item_id;
			$errors = array();
			if (!intval($_POST['category_id']))
			{
				$errors[] = "请选择分类";
			}
			else
			{
				$data['category_id'] = intval($_POST['category_id']);
			}
			/*
				TODO 保存状态
			*/
			/*
			//点击保存草稿或者直接发布按钮
			if ($_POST['publish'] && $item->status['shown'])
				$data['status'] = $item->status['shown']?$item->status['shown']['id']:$item->status['ready']['id'];
			else if ($_POST['saveonly'] && $item->status['auditing']) 
				$data['status'] = $item->status['auditing']['id'];
			*/
			//处理提交的数据
			include('edit_field.php');
			
			//提交数居后的处理
			if ($_fields['__after_edit']) $_fields['__after_edit']($data);
			
			if (count($data)>0 && count($errors) == 0)
			{
				//数据合法，写入数据库
				if ($item_id)
				{
					$re = $item->update( $item_id, $data);
				}
				else
				{
					$re = $item->add($data);

					if ($re && intval($re)) $item_id = intval($re);
				}
				if ($re)
				{
					//写入数据库后
					if ($_fields['__after_db']) $_fields['__after_db']($item->get_one($item_id));
					
					$return_to = 'admin.php?p=item&category_id='.$category_id;
					end_exit(lang('ITEM_SAVE_SUCCESS'),$return_to,1);
				}
				else
				{
					$action = 'edit_item';
					$err_msg = lang('ITEM_UNKNOWN_ERROR');
				}
			}
			else
			{
				$action = 'edit_item';
				//生成错误提示信息
				$err_msg = array();
				foreach($errors as $key=>$err)
				{
					$err_msg[] = $_fields[$key]['name'].' '.$err;
				}
				$err_msg = join('<br />',$err_msg);
			}
		}
		///////////////////////////////以下为显示控制部分////////////////////////////////
		//添加或者修改

		if ($action == 'edit_item' || $action =='new_item' || $action == 'view_item')
		{
			if($action == 'view_item') {
				$temp = template('item_view.html');
			} else {
				$temp = template('item_edit.html');
			}
			if (count($_POST)>0) //re-edit
			{
				$_item = $_POST;
			}
			elseif ($item_id) //edit
			{
				$_item = $item->get_one($item_id);
				//显示数居前的处理
				if ($_fields['__before_edit']) $_fields['__before_edit']($_item);
			}
			else //new
			{
				$_item = array();
			}
		
			$temp->assign( array(
				'content' => $_item,
				'item_id' => $item_id,
				'categories' => $category->get_list(),
				'category_id' => $category_id,
				'fields'=>$_fields,
				'this_category' => $this_category,
				'category_name' => $this_category['name'],
				'login_user' => $_SESSION['login_user'],
				'category_tree' => print_category_tree(
					$category->tree_category(0,$this_category['status']),
					$category_id),
			));
			if($action == 'view_item') {
				$view_data['page_description'] = '查看详情';
			} else {
				$view_data['page_description'] = lang('EDIT_ITEM');
			}
			$view_data['page_content'] = $temp->result();
		} 
		//显示内容列表
		else
		{
			$categories_arr = $category->get_list();
			$categories = array();
			$all_category = array();
			foreach($categories_arr as $c)
			{
				if ($c['parent_id'] == $category_id)
				{
					$categories[] = $c;
				}
				$all_category[$c['category_id']] = $c['name'];
			}

			//分页处理
			$cond = array('where'=>"(category_id='$category_id' OR category_id=0)");
			if (isset($_GET['status'])) $cond['status'] = intval($_GET['status']);
			if (isset($_GET['search'])) $cond['search'] = $_GET['search'];
			
			if ($_GET['order'] && $_GET['asc'])
				$cond['order'] = $_GET['order'].' asc';
			else if ($_GET['order'])
				$cond['order'] = $_GET['order'].' desc';
			
			//分页
			$items = end_page(
					$item,
					$cond,
					isset($config[$item_type.'_pagesize'])?$config[$item_type.'_pagesize']:20 //默认20条每页
				);

			//根据category_id得到category_name
			for($i=0;$i<count($items);$i++)
			{
				$_c = $all_category[$items[$i]['category_id']];
				$items[$i]['category_name'] = $_c?$_c:lang('DEFAULT_CATEGORY');
			}

			$view_data['categories'] = $categories;
			$view_data['items'] = $items;
			if ($category_id)
			{
				$view_data['this_category'] = $this_category;
				$view_data['this_category']['is_list'] = preg_match('/_list$/',$this_category['status']);
			}
			else
			{
				$view_data['this_category'] = array( 'is_list' => true);
			}
			$view_data['page_description'] = lang('ITEM_LIST');
		}

		//nav buttons
		$statuses = array();
		if (is_array($item->status))
		{
			foreach($item->status as $val) $statuses[$val['id']] = array('index'=>$val['id'],'value'=>$val['name']);
		}
		$view_data['statuses'] = $statuses;
		$view_data['category_tree'] = print_category_tree($category->tree_category(0,$this_category['status']));
		$view_data['current_status_all'] = isset($_GET['status'])?false:true;
		$view_data['err_msg'] = $err_msg;
		$view_data['success_msg'] = $success_msg;
		$view_data['position'] = $category->position_category($category_id);
		$view_data['status'] = $view_data['current_status_all']?'-1':$status;
		$view_data['table'] = $item_type;
		$view_data['category_id'] = $category_id;
		$list_tmp = template($item_type.'_list.html',END_MODEL_DIR.$item_type.'/');
		$list_tmp->assign($view_data);
		$view_data['list_content'] = $list_tmp->result();
	}
}

$_tree = $category->tree_category(0);
$view_data['all_category'] = print_category_tree_link('admin.php?p=item&category_id=',$_tree,$category_id);
$view_data['search'] = isset($_GET['search'])?$_GET['search']:'';
$view_data['category_id'] = $category_id;

function show_status($s)
{
	global $statuses;
	return $statuses[$s]?$statuses[$s]['value']:lang('UNKNOWN');
}

function showChannelName($ch) {
	$r = explode(',', $ch);
	$ch = '';
	foreach($r as $n) {
		switch($n) {
			case 0: 
				$ch .='情感 '; break;
			case 1: 
				$ch .='职场 '; break;
			case 2: 
				$ch .='创业 '; break;
		}
	}
	return $ch;
}

function showGender($g) {
	if(empty($g) && $g != 0) return '';	
	if($g == 1) {
		return '男';
	} else return '女';
}

function showProvince($p) {
	return ProvinceInfo::format_province($p);
}
