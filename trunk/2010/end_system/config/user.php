<?php

$end_user_config = array
(
	'user_id'=>array
	(
		'name'=>'用户ID',
		'type'=>'text',
		'width'=>100,
		'null'=>true,
		'disabled'=>true
	),
	'username'=>array
	(
		'name'=>'用户名',
		'type'=>'text',
		'width'=>250,
		'null'=>false,
		'disabled'=>true,
	),
	'email'=>array
	(
		'name'=>'Email',
		'type'=>'text',
		'width'=>250,
		'null'=>false,
	),
	'created_at'=>array
	(
		'name'=>'注册日期',
		'type'=>'text',
		'width'=>250,
		'null'=>false,
	),
	'register_ip'=>array
	(
		'name'=>'注册IP',
		'type'=>'text',
		'width'=>250,
		'prefilter'=>'long2ip',
		'filter'=>'ip2long',
		'null'=>false,
	),
	
	
);




