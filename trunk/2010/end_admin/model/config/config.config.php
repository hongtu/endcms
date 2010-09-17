<?php

$end_models['config'] = array(
	'name'=>"<span style='color:blue'>".lang('admin system config')."</span>",
	'type'=>'list',
	'list_items'=>20,
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
			'sort'=>true,
			'width'=>400
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
	unset($end_models['config']['list_fields']['name']);
	$end_models['config']['list_fields']['description']['edit'] = false;
}

