<?php
/**
 * article model config
 *
 * @author Liu Longbill
 */

$article_status = array( 
	0 => '<span style="color:blue">草稿</span>',
	1 => '<span style="color:green">已发布</span>',
	-1 => '<span style="color:grey">已删除</span>'
);

$end_models['article'] = array(
	'type' => 'list', //表示这是一个列表型的模型，对应一个数据库的表
	'name' => '文章列表',	//某型的名字，可以把一个栏目配置成某个模型
	'status' => $article_status,
	'list_items'=>20, //后台每页显示
	//'no_category'=>true,
	'category_fields'=> array(
		'name'=>array(
			'name'=>lang('Name'),
			'type'=>'text',
			'null'=>false
		),
		'description'=>array(
			'name'=>lang('Description'),
			'type'=>'text',
			'null'=>true
		),
		'keywords'=>array(
			'name'=>lang('Keywords'),
			'type'=>'text',
			'null'=>true
		)
	),
	'fields' => array(
		'name'=>array( 
			'name'=>'标题', 
			'type'=>'text', 
			'null'=>false, 
			'width'=>600, 
		),
		'is_photo'=>array( 
			'name'=>'是否是组图', 
			'type'=>'checkbox', 
			'null'=>true,
			'description'=>'如果是，请在下面的内容里上传所有图片，图片之间的文字将会作为上面图片的描述。第一张图片会作为封面。'
		),
		
		'content'=>array(
			'name'=>'内容',
			'type'=>'richtext',
			'null'=>false
		),
		'publish_time'=>array(
			'name'=>'发布日期',
			'type'=>'text',
			'null'=>false,
			'description'=>'例如: 2010-12-30',
			'default'=>date('Y-m-d')
		)
	),
	'list_fields' => array(
		'article_id'=>array(
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

		'create_time'=>array(
			'name'=>'创建日期',
			'width'=>120,
			'filter'=>'show_article_date',
			'sort'=>true
		),
		'category_id'=>array(
			'name'=>'分类',
			'width'=>100,
			'edit'=>true
		),
		'status'=>array(
			'name'=>'状态',
			'width'=>50,
			'edit'=>true,
			'type'=>'select',
			'options'=>$article_status
		),
		'_options'=>array(
			'name'=>'操作',
			'width'=>120,
			'filter'=>'show_article_options'
		)
	)
);

$end_rights[] = array(
	'name'=>'article',
	'description'=>'文章数据',
	'rights'=>array('view','add','update','delete')
);

function show_article_date($t)
{
	return date('Y-m-d H:i',$t);
}

function show_article_options($article)
{
	end_show_view_button($article['article_id']);
	end_show_edit_button($article['article_id']);
	end_show_delete_button($article['article_id']);
}
