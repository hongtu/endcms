<?php
/**
 * order model config
 *
 * @author Liu Longbill
 */

$order_status = array( 
	0 => '<span style="color:blue">new</span>',
	1 => '<span style="color:green">pending</span>',
	2 => '<span style="color:green">shipped</span>',
	3 => '<span style="color:grey">finished</span>'
);

$end_models['order'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => 'Order List',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $order_status,
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
		'name'=>array( 
			'name'=>'Customer Name', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>200, 
		),
		
		'email'=>array( 
			'name'=>'Email', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>200, 
		),
		
		'product_ids'=>array(
			'name'=>'Products',
			'type'=>'textarea',
			'null'=>false,
			'prefilter'=>'show_products'
		),
		
		'billing'=>array( 
			'name'=>'Billing info', 
			'type'=>'textarea', 
			'null'=>true, 
			'width'=>500,
			'height' =>100
		),
		
		'shipping'=>array( 
			'name'=>'Shipping info', 
			'type'=>'textarea', 
			'null'=>true, 
			'width'=>500,
			'height' =>100
		),
		
		
		'ship_method'=>array( 
			'name'=>'Shipping', 
			'type'=>'text', 
			'null'=>true, 
			'width'=>100
		),
		
		'shipping_price'=>array( 
			'name'=>'Shipping fee', 
			'type'=>'text', 
			'null'=>true, 
			'prefilter'=>'show_dollar',
			'width'=>100
		),
		'coupon'=>array( 
			'name'=>'Coupon', 
			'type'=>'text', 
			'null'=>true
		),
		'coupon_price'=>array( 
			'name'=>'Coupon', 
			'type'=>'text', 
			'prefilter'=>'show_dollar',
			'null'=>true
		),
		
		'total'=>array( 
			'name'=>'Total price', 
			'type'=>'text', 
			'prefilter'=>'show_dollar',
			'null'=>true, 
			'width'=>200, 
		),
		'create_time'=>array(
			'name'=>'Order time',
			'type'=>'datetime',
			'null'=>false
		)
		
	),
	'list_fields' => array(
		'order_id'=>array(
			'name'=>'ID',
			'width'=>'50',
			'sort'=>true,
			'align'=>'center',
		),
		'name'=>array(
			'name'=>'Customer',
			'width'=>100,
			'sort'=>true,
			'align'=>'center'
		),
		'email'=>array(
			'name'=>'E-mail',
			'width'=>100,
			'sort'=>true,
			'align'=>'center'
		),
		'total'=>array(
			'name'=>'Total Price',
			'width'=>100,
			'sort'=>true,
			'align'=>'center'
		),
		'create_time'=>array(
			'name'=>'Order Time',
			'width'=>120,
			'filter'=>'show_order_date',
			'sort'=>true
		),
		'status'=>array(
			'name'=>'Status',
			'width'=>100,
			'edit'=>true,
			'type'=>'select',
			'options'=>$order_status
		),
		'_options'=>array(
			'name'=>'Options',
			'width'=>120,
			'filter'=>'show_order_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'order',
	'description'=>'Order Data',
	'rights'=>array('view','add','update','delete')
);

function show_order_date($t)
{
	return date('Y-m-d H:i',$t);
}

function show_order_options($order)
{
	end_show_view_button($order['order_id']);
	//end_show_edit_button($order['order_id']);
	end_show_delete_button($order['order_id']);
}

function show_products($pids)
{
	include_once(END_ROOT.'end_www/model/product/product.model.php');
	$product = new MODEL_PRODUCT;
	$ps = explode(',',$pids);
	$s = '';
	foreach($ps as $_p)
	{
		list($pid,$qty) = explode('=',$_p);
		$p = $product->get_one($pid);
		$s .= '<a href="./?detail/'.$pid.'" target="_blank">'.$p['name'].'</a> Qty: '.$qty.'<br />';
	}
	return $s;
}

function show_dollar($s)
{
	return '$'.$s;
}