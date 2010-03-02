<?php


$category_status = array(
	'program_list' => "节目列表",
	'video_list' => "视频列表",
	'auction_list' => "拍卖列表",
	'person_list' => "嘉宾列表",
	'videofile_list' => "视频文件列表",
	'question_list'=>'问题列表',
	'audience_list' => '观众列表',
	'businesscase_list' => '创业案例列表',
	'page' => "<span style='color:#49e'>页面</span>",
	'fragment' => "<span style='color:orange'>碎片</span>",
	'text' => "<span style='color:#333'>文本</span>",
	'folder' => "<span style='color:#999'>目录</span>",
	'link' => "<span style='color:#872398'>链接</span>"
);


$end_category_config = array
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




