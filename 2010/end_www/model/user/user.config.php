<?php
/**
 * user model config
 *
 * @author Liu Longbill
 */

$user_status = array( 
	0 => '<span style="color:blue">retail</span>',
	1 => '<span style="color:green">to be verified</span>',
	2 => '<span style="color:green">wholesale</span>',
	-1 => '<span style="color:grey">banned</span>'
);

$end_models['user'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => 'Customer List',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $user_status,
	'list_items'=>20, //后台每页显示
	'no_category'=>true,
	'category_fields'=> array(
		'name'=>array(
			'name'=>'Name',
			'type'=>'text',
			'null'=>false
		)
	),
	'fields' => array(
		'email'=>array( 
			'name'=>'Email', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>600, 
		)	
	),
	'list_fields' => array(
		'user_id'=>array(
			'name'=>'ID',
			'width'=>'30',
			'sort'=>true,
			'align'=>'center',
		),
		'email'=>array(
			'name'=>'Email',
			'width'=>'auto',
			'sort'=>true,
			'type'=>'text',
			'search'=>true,
			'edit'=>true
		),

		'create_time'=>array(
			'name'=>'Register Date',
			'width'=>120,
			'filter'=>'show_user_date',
			'sort'=>true
		),
		'status'=>array(
			'name'=>'Status',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$user_status
		),
		'_options'=>array(
			'name'=>'Options',
			'width'=>120,
			'filter'=>'show_user_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'user',
	'description'=>'Customer Data',
	'rights'=>array('view','add','update','delete')
);

function show_user_date($t)
{
	return date('Y-m-d H:i',$t);
}

function show_user_options($user)
{
	end_show_view_button($user['user_id']);
	end_show_edit_button($user['user_id']);
	end_show_delete_button($user['user_id']);
}
