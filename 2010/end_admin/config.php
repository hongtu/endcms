<?php

$end_models = array();

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
		'rights'=> array('add','update','delete')
	),
	array( 
		'name'=>'item',
		'rights'=> array('view','add','update','delete')
	),
	array(
		'name'=>'account',
		'rights'=> array('update')
	),
	array(
		'name'=>'admin',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'config',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'upload',
		'rights'=>array('add')
	),
	array(
		'name'=>'rights',
		'rights'=>array('add','update','delete')
	)
);