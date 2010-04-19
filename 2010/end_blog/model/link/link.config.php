<?php
/**
 * link model config
 *
 * @author Liu Longbill
 */

$link_status = array( 
	0 => '<span style="color:blue">待审核</span>',
	1 => '<span style="color:green">已审核</span>',
	-1 => '<span style="color:grey">已删除</span>'
);

$end_models['link'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '链接列表',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $link_status,
	'list_items'=>20,
	'fields' => array(  //编辑字段
		'name'=>array( 
			'name'=>'链接文字', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>400, 
		),
		'url'=>array( 
			'name'=>'链接地址',
			'type'=>'text', 
			'null'=>false, 
			'width'=>400, 
		),
		'description'=>array(
			'name'=>'描述',
			'type'=>'textarea',
			'width'=>400,
			'height'=>100,
			'null'=>true,
		),
	),
	'list_fields' => array( //列表字段
		'order_id'=>array(
			'name'=>'优先级',
			'width'=>50,
			'sort'=>true,
			'edit'=>true,
			'align'=>'center',
		),
		'name'=>array(
			'name'=>'链接文字',
			'width'=>'150',
			'sort'=>true,
			'type'=>'text',
			'search'=>true,
			'edit'=>true
		),
		'url'=>array( 
			'name'=>'链接地址',
			'type'=>'text', 
			'search'=>true,
			'sort'=>true,
			'edit'=>true, 
			'width'=>'auto', 
		),
		'description'=>array(
			'name'=>'描述',
			'width'=>'auto',
			'height'=>'20',
			'sort'=>true,
			'type'=>'textarea',
			'search'=>true,
			'edit'=>true
		),
		'status'=>array(
					'name'=>'状态',
					'width'=>50,
					'edit'=>true,
					'type'=>'select',
					'options'=>$link_status
				),
		'_options'=>array(
			'name'=>'操作',
			'width'=>100,
			'filter'=>'show_link_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'link',
	'description'=>'链接数据管理',
	'rights'=>array('add','update','delete')
);

function show_link_status($status,$statuses)
{
	$status = intval($status);
	return $statuses[$status]?$statuses[$status]:'unkown';
}

function show_link_date($t)
{
	return date('Y-m-d H:i:s',$t);
}

function show_link_options($link)
{
	end_show_view_button($link['link_id']);
	end_show_edit_button($link['link_id']);
	end_show_delete_button($link['link_id']);
}
