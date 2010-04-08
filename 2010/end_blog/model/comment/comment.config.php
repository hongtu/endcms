<?php
/**
 * comment model config
 *
 * @author Liu Longbill
 */

$comment_status = array( 
	0 => '<span style="color:blue">待审核</span>',
	1 => '<span style="color:green">已审核</span>',
	-1 => '<span style="color:grey">已删除</span>'
);

$end_models['comment'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '评论列表',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $comment_status,
	'no_category'=>true,
	'fields' => array(  
		'blog_id'=>array(
			'name'=>'博客ID',
			'type'=>'text',
			'null'=>false,
			'width'=>50
		),
		'name'=>array( 
			'name'=>'姓名', 
			'type'=>'text', 
			'null'=>true, 
			'width'=>600, 
		),
		'email'=>array( 
			'name'=>'Email',
			'type'=>'text',
			'null'=>true,
			'width'=>600,
		),
		'url'=>array( 
			'name'=>'网址',
			'type'=>'text', 
			'null'=>true, 
			'width'=>600, 
		),
		'content'=>array(
			'name'=>'内容',
			'type'=>'textarea',
			'null'=>false,
		),
		'time'=>array(
			'name'=>'发布时间',
			'type'=>'datetime',
			'null'=>false,
		)
	),
	'list_fields' => array(
		'blog_id'=>array(
			'name'=>'日志ID',
			'width'=>50,
			'sort'=>true
		),
		'time'=>array(
			'name'=>'时间',
			'width'=>120,
			'filter'=>'show_comment_date',
			'sort'=>true
		),
		'name'=>array(
			'name'=>'姓名',
			'width'=>'100',
			'sort'=>true,
			'type'=>'text',
			'search'=>true,
			'edit'=>true
		),
		'content'=>array(
			'name'=>'内容',
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
			//'filter'=>'show_comment_status',
			'edit'=>true,
			'type'=>'select',
			'options'=>$comment_status
		),
		'_options'=>array(
			'name'=>'操作',
			'width'=>100,
			'filter'=>'show_comment_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'comment',
	'rights'=>array('add','update','delete')
);

function show_comment_status($status,$statuses)
{
	$status = intval($status);
	return $statuses[$status]?$statuses[$status]:'unkown';
}

function show_comment_date($t)
{
	return date('Y-m-d H:i:s',$t);
}

function show_comment_options($comment)
{
	end_show_edit_button($comment['comment_id']);
	end_show_delete_button($comment['comment_id']);
	echo ' <a href="admin.php?p=item&item_type=comment&comment_id='.$comment['comment_id'].'">评论</a> ';
}
