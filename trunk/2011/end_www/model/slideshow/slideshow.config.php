<?php
/**
 * slideshow model config
 *
 * @author Liu Longbill
 */

$slideshow_status = array( 
	0 => '<span style="color:blue">草稿</span>',
	1 => '<span style="color:green">已发布</span>',
	-1 => '<span style="color:grey">已删除</span>'
);

$end_models['slideshow'] = array(
	'type' => 'list', 
	'name' => 'slide show',
	'status' => $slideshow_status,
	'no_category'=>true,
	'fields' => array(  
		'name'=>array(
			'name'=>'标题',
			'type'=>'text',
			'null'=>false
		),
		'image'=>array(
			'name'=>'图片文件',
			'type'=>'image',
			'null'=>false
		),
		'url'=>array(
			'name'=>'链接地址',
			'type'=>'text',
			'null'=>true
		)
	),
	'list_fields' => array(
		'order_id'=>array(
			'name'=>'排序',
			'width'=>50,
			'sort'=>true,
			'edit'=>true
		),
		'name'=>array(
			'name'=>'标题',
			'width'=>'auto',
			'sort'=>true,
			'edit'=>true
		),
		'status'=>array(
			'name'=>'状态',
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
	'description'=>'Slideshow 数据',
	'rights'=>array('view','add','update','delete')
);

function show_slideshow_options($slideshow)
{
	end_show_view_button($slideshow['slideshow_id']);
	end_show_edit_button($slideshow['slideshow_id']);
	end_show_delete_button($slideshow['slideshow_id']);
}
