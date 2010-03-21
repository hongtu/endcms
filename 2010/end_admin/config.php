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

/*
	'text' => "<span style='color:#333'>文本</span>",
	'folder' => "<span style='color:#999'>目录</span>",
	'link' => "<span style='color:#872398'>链接</span>"
);

*/
$lz_category_config = array
(
	'program_list' => array(
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
		),
	),
	'video_list' => array(
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
		),
	),
	'videofile_list' => array(
		'name'=>array
		(
			'name'=>'原始文件名',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array
		(
			'name'=>'文件描述',
			'type'=>'text',
			'null'=>true
		),
	),
	'question_list' => array(
		'name'=>array
		(
			'name'=>'栏目',
			'type'=>'text',
			'null'=>false
		),
	),
	
	'folder' => array(
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
		),
		
	),
	'fragment' => array
	(
		'content' => array
		(
			'type'=>'richtext',
			'null'=>true,
			'filter'=>''
		)
	),
	'page' => array
	(
		'name2' => array
		(
			'name'=>'英文名',
			'type'=>'text',
			'null'=>1
		),
		'page_title'=> array
		(
			'name'=>'网页标题',
			'type'=>'text',
			'null'=>true,
			'filter'=>''
		),
		'content' => array
		(
			'name'=>'页面内容',
			'type'=>'richtext',
			'null'=>true,
			'filter'=>''
		)
	),
	'text' => array
	(
		'content' => array
		(
			'name'=>'内容',
			'type'=>'textarea',
			'null'=>true,
			'filter'=>''
		)
	),
	'link' => array
	(
		'target' => array
		(
			'name'=>'打开方式',
			'type'=>'select',
			'null'=>false,
			'options'=>array
			(
				'_self'=>'本窗口',
				'_blank'=>'新窗口',
			)
		),
		'name2' => array
		(
			'name'=>'英文名',
			'type'=>'text',
			'null'=>1
		)
	),
);



$end_rights = array
(
	array(
		'name'=>'category',
		'rights'=> array('add','update','delete')
	),
	array( 
		'name'=>'item',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'account',
		'rights'=> array('update')
	),
	array(
		'name'=>'HTML',
		'rights'=>array('update')
	),
	array(
		'name'=>'config',
		'rights'=> array('add','update','delete')
	),
	array(
		'name'=>'guestbook',
		'rights'=> array('update','delete')
	),
	array(
		'name'=>'upload',
		'rights'=>array('add')
	),
	array(
		'name'=>'user',
		'rights'=>array('add','update','update_password','delete')
	),
	array(
		'name'=>'rights',
		'rights'=>array('add','update','delete')
	),
	array(
		'name'=>'paper',
		'rights'=>array('view','update','delete')
	),
	array(
		'name'=>'blog',
		'rights'=>array('view','add','update','delete')
	)
);