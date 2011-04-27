<?php
/**
 * contact model config
 *
 * @author Liu Longbill
 */

$end_models['contact'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '留言列表',	//某型的名字，可以把一个栏目配置成某个模型
	'list_items'=>20, //后台每页显示
	'no_category'=>true,
	'category_fields'=> array(
		'name'=>array(
			'name'=>lang('Name'),
			'type'=>'text',
			'null'=>false
		)
	),
	'fields' => array(),
	'list_fields' => array(
		'contact_id'=>array(
			'name'=>'ID',
			'width'=>'30',
			'sort'=>true,
			'align'=>'center',
		),
		'name'=>array(
			'name'=>'姓名',
			'width'=>'auto',
			'sort'=>true,
			'type'=>'text',
			'search'=>true
		),

	'email'=>array(
		'name'=>'邮箱',
		'width'=>'auto',
		'sort'=>true,
		'type'=>'text',
		'search'=>true
	),
	'phone'=>array(
		'name'=>'电话',
		'width'=>'auto',
		'sort'=>true,
		'type'=>'text',
		'search'=>true
	),
'content'=>array(
	'name'=>'内容',
	'width'=>'auto',
	'sort'=>true,
	'type'=>'text',
	'search'=>true
),

		'create_time'=>array(
			'name'=>'日期',
			'width'=>120,
			'sort'=>true
		),
		'_options'=>array(
			'name'=>'操作',
			'width'=>120,
			'filter'=>'show_contact_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'contact',
	'description'=>'留言数据',
	'rights'=>array('view','delete')
);

function show_contact_options($contact)
{
	end_show_delete_button($contact['contact_id']);
}
