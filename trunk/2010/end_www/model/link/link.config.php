<?php
/**
 * link model config
 *
 * @author Liu Longbill
 */

// $link_status = array( 
// 	0 => '<span style="color:blue">draft</span>',
// 	1 => '<span style="color:green">published</span>'
// );

$link_targets = array(
	'_self'=>'Self',
	'_blank'=>'Blank'
);

$end_models['link'] = array(
	'type' => 'list', 
	'name' => 'Link List',
	//'status' => $link_status,
	//'no_category'=>true,
	'fields' => array(  
		'name'=>array(
			'name'=>'Name',
			'type'=>'text',
			'null'=>false
		),
		'url'=>array(
			'name'=>'Link URL',
			'type'=>'text',
			'null'=>false
		),
		'target'=>array(
			'name'=>'Target window',
			'type'=>'select',
			'width'=>100,
			'options'=>$link_targets
		)
	),
	'list_fields' => array(
		'order_id'=>array(
			'name'=>'Order',
			'width'=>50,
			'sort'=>true,
			'edit'=>true,
			'align'=>'center'
		),
		'name'=>array(
			'name'=>'Name',
			'width'=>'auto',
			'sort'=>true,
			'edit'=>true
		),
		'url'=>array(
			'name'=>'Link URL',
			'width'=>'auto',
			'sort'=>true,
			'edit'=>true
		),
		'target'=>array(
			'name'=>'Target',
			'width'=>'80',
			'edit'=>true,
			'type'=>'select',
			'options'=>$link_targets
		),
		'_options'=>array(
			'name'=>'options',
			'width'=>100,
			'filter'=>'show_link_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'link',
	'description'=>'Link Data',
	'rights'=>array('view','add','update','delete')
);

function show_link_options($link)
{
	end_show_edit_button($link['link_id']);
	end_show_delete_button($link['link_id']);
}
