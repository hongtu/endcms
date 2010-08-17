<?php

//数据库记录单个管理员后台操作的最大条数
define('END_ADMIN_LOG_NUM',1000);

language('common');
language('config_php');

$end_module['admin'] = array('name'=>lang('admin module'));

$end_models = array();
$end_models['config'] = array(
	'name'=>"<span style='color:blue'>".lang('admin system config')."</span>",
	'type'=>'list',
	'list_items'=>10,
	'category_fields'=>array(
		'name'=>array(
			'name'=>lang('admin cat name'),
			'type'=>'text',
			'null'=>false
		),
		'description'=> array(
			'name'=>lang('category description'),
			'type'=>'text',
			'null'=>true,
		)
	),
	'list_fields'=>array(
		'order_id'=>array(
			'name'=>lang('Order'),
			'edit'=>true,
			'width'=>50,
			'sort'=>true
		),
		'name'=>array(
			'name'=>lang('config var name'),
			'search'=>true,
			'width'=>100,
			'sort'=>true
		),
		'description'=>array(
			'name'=>lang('Description'),
			'edit'=>true,
			'search'=>true,
			'sort'=>true
		),
		'value'=>array(
			'name'=>lang('config value'),
			'edit'=>true,
			'type'=>'textarea',
			'height'=>'20',
			'search'=>true,
			'sort'=>true
		),
		'_options'=>array(
			'name'=>lang('options'),
			'filter'=>'end_config_options'
		),
	),
	'fields'=>array(
		'name'=>array(
			'name'=>lang('config var name'),
			'type'=>'text',
			'width'=>200
		),
		'description'=>array(
			'name'=>lang('description'),
			'width'=>200,
			'type'=>'text'
		),
		'value'=>array(
			'name'=>lang('config value'),
			'width'=>400,
			'height'=>200,
			'type'=>'textarea',
		)
	),
);


if (END_DEBUG === false)
{
	$end_models['config']['list_fields']['description']['edit'] = false;
}


$end_models['page'] = array(
	'name'=>"<span style='color:#49e'>".lang('admin page')."</span>",
	'category_fields'=>array(
		'name'=>array(
			'name'=>lang('page name'),
			'type'=>'text',
			'null'=>false
		),
		'page_title'=> array(
			'name'=>lang('page title'),
			'type'=>'text',
			'null'=>false,
		),
		'description'=> array(
			'name'=>lang('page description'),
			'type'=>'text',
			'null'=>true,
		),
		'keywords'=> array(
			'name'=>lang('page keywords'),
			'type'=>'text',
			'null'=>true,
		),
		'content' => array(
			'name'=>lang('page content'),
			'type'=>'richtext',
			'null'=>true,
		),
		'update_time'=>array(
			'name'=>lang('update time'),
			'type'=>'datetime',
			'null'=>true
		)
	)
);


$end_models['fragment'] = array(
	'name'=>"<span style='color:#49e'>".lang('fragment')."</span>",
	'category_fields'=>array(
		'name'=>array(
			'name'=>lang('Name'),
			'type'=>'text',
			'null'=>false
		),
		'content' => array(
			'name'=>lang('Content'),
			'type'=>'richtext',
			'null'=>true,
		)
	)
);


$end_models['link'] = array(
	'name'=>"<span style='color:#872398'>".lang('link')."</span>",
	'category_fields'=>array(
		'name'=>array(
			'name'=>lang('Name'),
			'type'=>'text',
			'null'=>false
		),
		'url'=>array(
			'name'=>lang('URL'),
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>lang('Description'),
			'type'=>'text',
			'null'=>true
		),
		'target'=>array(
			'name'=>lang('target window'),
			'type'=>'select',
			'options'=>array(
				'_self'=>lang('target_self'),
				'_blank'=>lang('target_blank')
			),
			'width'=>'100',
			'null'=>true
		)
	)
);

$end_models['folder'] = array(
	'name'=>lang('Folder'),
	'category_fields'=>array(
		'name'=>array
		(
			'name'=>lang('Name'),
			'type'=>'text',
			'null'=>false
		),
		'description'=>array
		(
			'name'=>lang('Description'),
			'type'=>'text',
			'null'=>true
		)
	)
);

//权限的种类
$end_rights = array
(
	array(
		'name'=>'category',
		'description'=>lang('Categories'),
		'rights'=> array('view','add','update','delete')
	),
	array(
		'name'=>'item',
		'description' => lang('Contents'),
		'rights'=> array('view','add','update','delete')
	),
	array(
		'name'=>'account',
		'description'=>lang('Change password'),
		'rights'=> array('update')
	),
	array(
		'name'=>'admin',
		'description'=> lang('Administrators'),
		'rights'=> array('view','add','update','update_password','delete')
	),
	array(
		'name'=>'config',
		'description'=>lang('Configuration'),
		'rights'=> array('view','add','update','delete')
	),
	array(
		'name'=>'extension',
		'description'=>lang('Extensions'),
		'rights'=>array('view','add','update','delete')
	),
	array(
		'name'=>'upload',
		'description'=>lang('Upload Files'),
		'rights'=>array('add')
	),
	array(
		'name'=>'rights',
		'description'=>lang('Role and ACL'),
		'rights'=>array('view','add','update','delete')
	)
);


function end_config_options($c)
{
	end_show_edit_button($c['config_id']);
	end_show_delete_button($c['config_id']);
}
