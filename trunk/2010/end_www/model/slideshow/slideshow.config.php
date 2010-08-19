<?php
/**
 * slideshow model config
 *
 * @author Liu Longbill
 */

$slideshow_status = array( 
	0 => '<span style="color:blue">draft</span>',
	1 => '<span style="color:green">published</span>'
);

$end_models['slideshow'] = array(
	'type' => 'list', 
	'name' => 'Slideshow Photos',
	'status' => $slideshow_status,
	'no_category'=>true,
	'fields' => array(  
		'name'=>array(
			'name'=>'Image Name',
			'type'=>'text',
			'null'=>false
		),
		'image'=>array(
			'name'=>'Image file',
			'type'=>'image',
			'null'=>false
		),
		'url'=>array(
			'name'=>'Link URL',
			'type'=>'text',
			'null'=>true
		)
	),
	'list_fields' => array(
		'order_id'=>array(
			'name'=>'Order',
			'width'=>50,
			'sort'=>true,
			'edit'=>true
		),
		'name'=>array(
			'name'=>'Name',
			'width'=>'auto',
			'sort'=>true,
			'edit'=>true
		),
		'status'=>array(
			'name'=>'Status',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$slideshow_status
		),
		'_options'=>array(
			'name'=>'options',
			'width'=>100,
			'filter'=>'show_slideshow_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'slideshow',
	'description'=>'Slideshow Data',
	'rights'=>array('view','add','update','delete')
);

function show_slideshow_options($slideshow)
{
	end_show_view_button($slideshow['slideshow_id']);
	end_show_edit_button($slideshow['slideshow_id']);
	end_show_delete_button($slideshow['slideshow_id']);
}
