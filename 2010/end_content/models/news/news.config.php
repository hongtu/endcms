<?php
/**
 * news model config
 *
 * @author Liu Longbill
 */

$end_models['news'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '新闻列表',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => array( //数据表里每条记录有几种状态，一般大于0的是可以显示在前台的，
		0 => '草稿',
		1 => '已发布',
		-1 => '已删除'
	),
	'category_fields'=> array(
		'name'=>array(
			'name'=>'栏目标题',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>'描述',
			'type'=>'text',
			'null'=>true
		),
		'keywords'=>array(
			'name'=>'关键词',
			'type'=>'text',
			'null'=>true
		)	
	),
	'fields' => array(  //后台编辑数据的时候需要怎样呈献和处理模型的每个字段
		'__before_edit'=> '',//数据从数据库中读取出来，但在显示数据之前的操作函数
		'__after_edit' => '',//数据编辑提交之后，存入数据库之前
		'__after_db' => '',//数据存入数据库之后的操作
		'title'=>array( //'title' 必须对应模型数据表的字段名
			'name'=>'标题', //必须，后台显示的字段名
			'type'=>'text', //必须，输入框的类型，目前有,text,textarea,richtext,file,checkbox,select等可选
			'null'=>false, //可选，是否允许为空
			'width'=>600, //输入框宽度
		),
		'author'=>array(
			'name'=>'作者',
			'type'=>'text',
			'width'=>200,
			'null'=>false,
		),
		'created_at'=>array(
			'name'=>'发布日期',
			'type'=>'date',
			'null'=>false,
		),
		'content'=>array(
			'name'=>'内容',
			'type'=>'richtext',
			'null'=>false,
			'height'=>500
		)
	)
);