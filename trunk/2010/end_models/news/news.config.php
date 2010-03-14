<?php
/**
 * news model config
 *
 * @author Liu Longbill
 */
$end_models['news'] = array();
$end_models['news']['fields'] = array
(
	//数据从数据库中读取出来，但在显示数据之前的操作函数
	'__before_edit'=> '',
	//数据编辑提交之后，存入数据库之前
	'__after_edit' => '',
	//数据存入数据库之后的操作
	'__after_db' => '',
	'title'=>array
	(
		'name'=>'标题',
		'type'=>'text',
		'null'=>false,
	),
	'author'=>array
	(
		'name'=>'作者',
		'type'=>'text',
		'width'=>200,
		'null'=>false,
	),
	'created_at'=>array
	(
		'name'=>'发布日期',
		'type'=>'date',
		'null'=>false,
	),
	'content'=>array
	(
		'name'=>'内容',
		'type'=>'richtext',
		'filter'=>'',
		'null'=>false,
		'height'=>500
	),	
);