<?php
/**
 * blog model config
 *
 * @author Liu Longbill
 */

$blog_status = array( 
	0 => '<span style="color:blue">草稿</span>',
	1 => '<span style="color:green">已发布</span>',
	-1 => '<span style="color:grey">隐藏</span>'
);

$end_models['blog'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '博客文章列表',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $blog_status,
	'list_items'=>2, //后台每页显示
	//'no_category'=>true,
	'category_fields'=> array(
		'name'=>array(
			'name'=>'栏目标题',
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>'描述',
			'type'=>'text',
			'null'=>true
		),
		'keywords'=>array(
			'name'=>'关键词',
			'type'=>'text',
			'null'=>true
		)	
	),
	'fields' => array(  //后台编辑数据的时候需要怎样呈献和处理模型的每个字段
		'__before_edit'=> '',//数据从数据库中读取出来，但在显示数据之前的操作函数
		'__after_edit' => '',//数据编辑提交之后，存入数据库之前
		'__after_db' => '',//数据存入数据库之后的操作
		'name'=>array( //'title' 必须对应模型数据表的字段名
			'name'=>'标题', //必须，后台显示的字段名
			'type'=>'text', //必须，输入框的类型，目前有,text,textarea,richtext,file,checkbox,select等可选
			'null'=>false, //可选，是否允许为空
			'width'=>600, //输入框宽度
		),
		'url'=>array(
			'name'=>'URL',
			'type'=>'text',
			'null'=>true,
		),
		'content'=>array(
			'name'=>'内容',
			'type'=>'richtext',
			'null'=>false,
		),
		'create_time'=>array(
			'name'=>'发布日期',
			'type'=>'datetime',
			'null'=>false,
		)
	),
	'list_fields' => array(
		'blog_id'=>array(
			'name'=>'ID',
			'width'=>'30',
			'sort'=>true,
			'align'=>'center',
		),
		'order_id'=>array(
			'name'=>'排序',
			'width'=>'35',
			'edit'=>true,
			'sort'=>true,
			'align'=>'center',
		),
		
		'name'=>array(
			'name'=>'标题',
			'width'=>'auto',
			'sort'=>true,
			'type'=>'text',
			'search'=>true,
			'edit'=>true
		),
		// 'url'=>array(
		// 		'name'=>'URL',
		// 		'width'=>'auto',
		// 		'sort'=>true,
		// 		'search'=>true,
		// 		'edit'=>true,
		// 	),
		'create_time'=>array(
			'name'=>'创建日期',
			'width'=>120,
			'filter'=>'show_blog_date',
			'sort'=>true
		),
		'category_id'=>array(  /*  此字段只需要配置以下几个，其他由系统自动配置  */
			'name'=>'所属栏目',
			'width'=>100,
			'edit'=>true
		),
		'status'=>array(
			'name'=>'状态',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$blog_status
		),
		'view_count'=>array(
			'name'=>'浏览',
			'width'=>'35',
			'align'=>'center',
			'sort'=>true
		),
		'comment_count'=>array(
			'name'=>'评论',
			'width'=>'35',
			'align'=>'center',
			'sort'=>true
		),
		'_options'=>array(
			'name'=>'操作',
			'width'=>120,
			'filter'=>'show_blog_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'blog',
	'description'=>'博客数据管理',
	'rights'=>array('view','add','update','delete')
);

function show_blog_date($t)
{
	return date('Y-m-d H:i:s',$t);
}

function show_blog_options($blog)
{
	end_show_view_button($blog['blog_id']);
	end_show_edit_button($blog['blog_id']);
	end_show_delete_button($blog['blog_id']);
	echo ' <a href="admin.php?p=item&item_type=comment&search[blog_id]='.$blog['blog_id'].'">评论</a> ';
}
