<?php
/**
 * coupon model config
 *
 * @author Liu Longbill
 */

$coupon_status = array( 
	0 => '<span style="color:blue">valid</span>',
	-1 => '<span style="color:grey">invalid</span>'
);

$end_models['coupon'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => 'Coupon List',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $coupon_status,
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
			'name'=>'Coupon code', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>600, 
		),
		'price'=>array(
			'name'=>'Discount expression',
			'type'=>'text',
			'null'=>false,
			'width'=>300,
			'description'=>'Expression of discount.<br />Use {total} to express total price of order<br>'
				.'Use {shipping} to express shipping fee<br>'
				.'Use {subtotal} to express total price of products (without shipping fee)'
				.'Examples: <br>'
				.'10 <span style="color:#aaa">$10 off</span><br>'
				.'0.2*{total} <span style="color:#aaa">20% off of total price (including shipping fee)</span><br>'
				.'{shipping} <span style="color:#aaa">no shipping fee</span><br>'
				.'0.5*{shipping}+10 <span style="color:#aaa">half shipping fee and $10 off</span><br>'
		),
		'start_price'=>array(
			'name'=>'Starting from',
			'type'=>'text',
			'width'=>'100',
			'filter'=>'floatval'
		),
		'description'=>array(
			'name'=>'Description',
			'type'=>'text',
			'null'=>true,
			'width'=>600
		),
		'count'=>array(
			'name'=>'Coupon quantity',
			'type'=>'text',
			'null'=>true,
			'fileter'=>'intval',
			'width'=>100
		),
		'from_time'=>array(
			'name'=>'Valid From',
			'type'=>'datetime',
			'description'=>' YYYY-MM-DD hh:mm:ss'	
		),
		
		'to_time'=>array(
			'name'=>'Valid To',
			'type'=>'datetime',
			'description'=>' YYYY-MM-DD hh:mm:ss'	
		)
	),
	'list_fields' => array(
		'name'=>array(
			'name'=>'Code',
			'width'=>'auto',
			'sort'=>true,
			'align'=>'center'
		),
		'description'=>array(
			'name'=>'Description',
			'width'=>'auto',
			'sort'=>true
		),
		
		'price'=>array(
			'name'=>'Expression',
			'width'=>'100',
			'sort'=>true,
			'align'=>'center'
		),
		'count'=>array(
			'name'=>'Left qty',
			'width'=>'60',
			'sort'=>true,
			'align'=>'center'
		),
		
		'from_time'=>array(
			'name'=>'Falid from',
			'width'=>120,
			'filter'=>'show_coupon_date',
			'sort'=>true
		),
		'to_time'=>array(
			'name'=>'Falid to',
			'width'=>120,
			'filter'=>'show_coupon_date',
			'sort'=>true
		),
		
		'status'=>array(
			'name'=>'Status',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$coupon_status
		),
		'_options'=>array(
			'name'=>'Options',
			'width'=>120,
			'filter'=>'show_coupon_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'coupon',
	'description'=>'Coupon Data',
	'rights'=>array('view','add','update','delete')
);

function show_coupon_date($t)
{
	return date('Y-m-d H:i',$t);
}

function show_coupon_options($coupon)
{
	end_show_view_button($coupon['coupon_id']);
	end_show_edit_button($coupon['coupon_id']);
	end_show_delete_button($coupon['coupon_id']);
}
