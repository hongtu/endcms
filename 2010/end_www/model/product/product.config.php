<?php
/**
 * product model config
 *
 * @author Liu Longbill
 */

$product_status = array( 
	0 => '<span style="color:blue">draft</span>',
	1 => '<span style="color:green">published</span>',
	-1 => '<span style="color:grey">hidden</span>'
);

$end_models['product'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => 'Product List',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $product_status,
	'list_items'=>20, //后台每页显示
	//'no_category'=>true,
	'category_fields'=> array(
		'name'=>array(
			'name'=>'Name',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>'Description',
			'type'=>'text',
			'null'=>true
		),
		'keywords'=>array(
			'name'=>'Keywords',
			'type'=>'text',
			'null'=>true
		),
		'image'=>array(
			'name'=>'Image file',
			'type'=>'image',
			'null'=>false,
			'max_width'=>400
		)
	),
	'fields' => array(
		'name'=>array( 
			'name'=>'Title', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>600, 
		),
		'retail'=>array(
			'name'=>'Retail Price',
			'type'=>'text',
			'null'=>false,
			'width'=>100
		),
		'wholesale'=>array(
			'name'=>'Wholesale Price',
			'type'=>'text',
			'null'=>false,
			'width'=>100
		),
		'image'=>array(
			'name'=>'Image file',
			'type'=>'image',
			'null'=>false,
			'max_width'=>500
		),
		'content'=>array(
			'name'=>'Description',
			'type'=>'richtext',
			'null'=>false
		)
	),
	'list_fields' => array(
		'product_id'=>array(
			'name'=>'ID',
			'width'=>'30',
			'sort'=>true,
			'align'=>'center',
		),
		'order_id'=>array(
			'name'=>'Order',
			'width'=>'35',
			'edit'=>true,
			'sort'=>true,
			'align'=>'center',
		),
		
		'name'=>array(
			'name'=>'Title',
			'width'=>'auto',
			'sort'=>true,
			'type'=>'text',
			'search'=>true,
			'edit'=>true
		),

		'create_time'=>array(
			'name'=>'Create time',
			'width'=>120,
			'filter'=>'show_product_date',
			'sort'=>true
		),
		'category_id'=>array(
			'name'=>'Category',
			'width'=>100,
			'edit'=>true
		),
		'status'=>array(
			'name'=>'Status',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$product_status
		),
		'_options'=>array(
			'name'=>'Options',
			'width'=>120,
			'filter'=>'show_product_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'product',
	'description'=>'Product Data',
	'rights'=>array('view','add','update','delete')
);

function show_product_date($t)
{
	return date('Y-m-d H:i:s',$t);
}

function show_product_options($product)
{
	end_show_view_button($product['product_id']);
	end_show_edit_button($product['product_id']);
	end_show_delete_button($product['product_id']);
}
