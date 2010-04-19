<?php


$end_models = array();


$end_models['config'] = array(
	'name'=>"系统设置",
	'type'=>'list',
	'list_items'=>10,
	'category_fields'=>array(
		'name'=>array(
			'name'=>'页面名称',
			'type'=>'text',
			'null'=>false
		),
		'description'=> array(
			'name'=>'描述',
			'type'=>'text',
			'null'=>true,
		)
	),
	'list_fields'=>array(
		'order_id'=>array(
			'name'=>'优先级',
			'edit'=>true,
			'width'=>50,
			'sort'=>true
		),
		'name'=>array(
			'name'=>'变量名',
			'search'=>true,
			'width'=>100,
			'sort'=>true
		),
		'description'=>array(
			'name'=>'描述',
			'edit'=>true,
			'search'=>true,
			'sort'=>true
		),
		'value'=>array(
			'name'=>'值',
			'edit'=>true,
			'type'=>'textarea',
			'height'=>'20',
			'search'=>true,
			'sort'=>true
		),
		'_options'=>array(
			'name'=>'操作',
			'filter'=>'end_config_options'
		),
	),
	'fields'=>array(
		'name'=>array(
			'name'=>'变量名',
			'type'=>'text',
			'width'=>200
		),
		'description'=>array(
			'name'=>'描述',
			'width'=>200,
			'type'=>'text'
		),
		'value'=>array(
			'name'=>'值',
			'width'=>400,
			'height'=>200,
			'type'=>'textarea',
		)
	),
);

$end_models['page'] = array(
	'name'=>"<span style='color:#49e'>页面</span>",
	'category_fields'=>array(
		'name'=>array(
			'name'=>'页面名称',
			'type'=>'text',
			'null'=>false
		),
		'page_title'=> array(
			'name'=>'网页标题',
			'type'=>'text',
			'null'=>false,
		),
		'description'=> array(
			'name'=>'网页描述',
			'type'=>'text',
			'null'=>true,
		),
		'keywords'=> array(
			'name'=>'网页关键词',
			'type'=>'text',
			'null'=>true,
		),
		'content' => array(
			'name'=>'页面内容',
			'type'=>'richtext',
			'null'=>true,
		),
		'update_time'=>array(
			'name'=>'更新时间',
			'type'=>'datetime',
			'null'=>true
		)
	)
);


$end_models['link'] = array(
	'name'=>"<span style='color:#872398'>链接</span>",
	'category_fields'=>array(
		'name'=>array(
			'name'=>'链接名称',
			'type'=>'text',
			'null'=>false
		),
		'url'=>array(
			'name'=>'链接地址',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>'提示文字',
			'type'=>'text',
			'null'=>true
		),
		'target'=>array(
			'name'=>'打开方式',
			'type'=>'select',
			'options'=>array(
				'_self'=>'本窗口',
				'_blank'=>'新窗口'
			),
			'width'=>'100',
			'null'=>true
		)
	)
);

$end_models['folder'] = array(
	'name'=>'目录',
	'category_fields'=>array(
		'name'=>array
		(
			'name'=>'栏目名字',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array
		(
			'name'=>'栏目描述',
			'type'=>'text',
			'null'=>true
		)
	)
);


$end_rights = array
(
	array(
		'name'=>'category',
		'description'=>'分类管理',
		'rights'=> array('add','update','delete')
	),
	array( 
		'name'=>'item',
		'description'=>'内容管理',
		'rights'=> array('view','add','update','delete')
	),
	array(
		'name'=>'account',
		'description'=>'更改密码',
		'rights'=> array('update')
	),
	array(
		'name'=>'admin',
		'description'=>'管理员管理',
		'rights'=> array('add','update','update_password','delete')
	),
	array(
		'name'=>'config',
		'description'=>'系统设置',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'upload',
		'description'=>'文件上传',
		'rights'=>array('add')
	),
	array(
		'name'=>'rights',
		'description'=>'角色/权限管理',
		'rights'=>array('add','update','delete')
	)
);


function end_config_options($c)
{
	end_show_edit_button($c['config_id']);
	end_show_delete_button($c['config_id']);
}