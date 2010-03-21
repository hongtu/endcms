<?php

$end_item_config = array
(
	/*
	节目编辑字段类型配置
	对应数据库 program表。
	*/
	'program' => array(
		//数据从数据库中读取出来，但在显示数据之前的操作函数
		'__before_edit'=> 'program_before_edit',
		//数据编辑提交之后，存入数据库之前
		'__after_edit' => 'program_after_edit',
		//数据存入数据库之后的操作
		'__after_db' => 'program_after_db',
		'title'=>array
		(
			'name'=>'标题',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
		),
		'image'=>array
		(
			'name'=>'预告图片',
			'type'=>'file',
			'allowed_exts'=>array('jpg','jpeg','png','gif'),
			'rename'=>true,
			'filter'=>null,
			//'saveto'=> 'public/'.date('Y').'/', //如果不配置此项，那么存到 END_UPLOAD_DIR 下 
			'null'=>true
		),
		'persons'=>array //非数据表字段，编辑后会有函数program_after_edit()处理
		(
			'name'=>'嘉宾',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
			'width'=>200
		),
		'person_description'=>array
		(
			'name'=>'嘉宾介绍',
			'type'=>'richtext',
			'filter'=>'',
			'null'=>false,
			'height'=>120
		),
		'brief_intro'=>array
		(
			'name'=>'节目文字介绍',
			'type'=>'richtext',
			'filter'=>'',
			'null'=>false,
			'height'=>120
		),
		'content'=>array
		(
			'name'=>'节目图文介绍',
			'type'=>'richtext',
			'filter'=>'',
			'null'=>false,
			'height'=>300
		),
		'launch_date'=>array
		(
			'name'=>'直播时间',
			'type'=>'datetime',
			'filter'=>'',
			'null'=>false,
			//'width'=>250,
			//'description'=>'格式：2011-12-20 13:56:59'
		),
		
		'bbs_url'=>array
		(
			'name'=>'论坛地址',
			'type'=>'text',
			'filter'=>'',
			'null'=>true,
		),
		'video_url'=>array
		(
			'name'=>'视频地址',
			'type'=>'text',
			'filter'=>'',
			'null'=>true,
		),
		
	),
	//视频
	'video' => array(
		'__before_edit'=> 'video_before_edit',
		'__after_edit' => 'video_after_edit',
		'__after_db' => 'video_after_db',
		'title'=>array
		(
			'name'=>'标题',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
		),
		'picture'=>array
		(
			'name'=>'缩略图',
			'type'=>'file',
			'allowed_exts'=>array('jpg','jpeg','png','gif'),
			'rename'=>true,
			'filter'=>null,
			//'saveto'=> 'public/images/',
			'null'=>true
		),
		'persons'=>array//非数据表字段，编辑后会有函数video_after_edit()处理
		(
			'name'=>'嘉宾',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
			'width'=>200,
			'description'=>'逗号或空格分隔'
		),
		'person_intro'=>array
		(
			'name'=>'嘉宾介绍',
			'type'=>'textarea',
			'filter'=>'',
			'null'=>false,
			'height'=>100
		),
		'duration'=>array
		(
			'name'=>'时长',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
			'width'=>100,
			'description'=>'单位：秒'
		),
		'tag'=>array//非数据表字段，编辑后会有函数video_after_edit()处理
		(
			'name'=>'Tag',
			'type'=>'text',
			'width'=>'400',
			'description'=>'逗号或空格分隔',
			'null'=>true
		),
		'file'=>array
		(
			'name'=>'视频地址',
			'type'=>'text',
			'null'=>false
		),
		'brief_intro'=>array
		(
			'name'=>'内容介绍',
			'type'=>'richtext',
			'filter'=>'',
			'null'=>false,
			'height'=>300
		),
		
		'bbs_url'=>array
		(
			'name'=>'论坛地址',
			'type'=>'text',
			'filter'=>'',
			'null'=>true,
		),
		
		
	),
	//视频文件
	'videofile' => array(
		'original_filename'=>array
		(
			'name'=>'原始文件名',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
		),
		'storage_filename'=>array
		(
			'name'=>'存储文件地址',
			'type'=>'text',
			'filter'=>null,
			'null'=>true
		),	
		'filesize'=>array
			(
				'name'=>'文件大小',
				'type'=>'text',
				'filter'=>'intval',
				'null'=>true
			)
	),
	//问题
	'question' => array(
		'title'=>array
		(
			'name'=>'问题',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
		)
	),
	//拍卖
	'auction' => array(
		'__before_edit'=> 'auction_before_edit',
		'__after_edit' => 'auction_after_edit',
		'__after_db' => 'auction_after_db',
		'title'=>array
		(
			'name'=>'标题',
			'type'=>'text',
			'filter'=>'',
			'null'=>false,
		),
		'picture'=>array
		(
			'name'=>'缩略图',
			'type'=>'file',
			'allowed_exts'=>array('jpg','jpeg','png','gif'),
			'rename'=>true,
			'filter'=>null,
			//'saveto'=> 'public/images/',
			'null'=>true
		),
		'start_date'=>array
		(
			'name'=>'拍卖开始',
			'type'=>'datetime'
		),
		'end_date'=>array
		(
			'name'=>'拍卖结束',
			'type'=>'datetime'
		),
		'base_price'=>array
		(
			'name'=>'起拍价',
			'type'=>'text',
			'filter'=>'floatval',
			'null'=>false,
			'width'=>100,
			'description'=>'单位：元'
		),
		'step_price'=>array
		(
			'name'=>'最低加价',
			'type'=>'text',
			'filter'=>'floatval',
			'null'=>false,
			'width'=>100,
			'description'=>'单位：元'
		),
		'guaranty_price'=>array
		(
			'name'=>'保证金',
			'type'=>'text',
			'filter'=>'floatval',
			'null'=>false,
			'width'=>100,
			'description'=>'单位：元'
		),
		'bbs_url'=>array
		(
			'name'=>'论坛地址',
			'type'=>'text',
			'filter'=>'',
			'null'=>true,
		),
		'template'=>array//非数据表字段，编辑后会有函数auction_after_edit()处理
		(
			'name'=>'模板代码',
			'type'=>'textarea',
			'width'=>600,
			'height'=>500,
			'null'=>false
		),
		
	),
	//嘉宾
	'person' => array(
		'user_name'=>array
		(
			'name'=>'姓名',
			'type'=>'text',
			'filter'=>'',
			'width'=>150,
			'null'=>false,
		),
		'avatar'=>array
		(
			'name'=>'头像',
			'type'=>'file',
			'allowed_exts'=>array('jpg','jpeg','png','gif'),
			'rename'=>true,
			'filter'=>null,
			//'saveto'=> 'public/images/',
			'null'=>true
		),
		'title'=>array
		(
			'name'=>'职务',
			'type'=>'text',
			'filter'=>'',
			'width'=>200,
			'null'=>true,
		),
		'company'=>array
		(
			'name'=>'公司',
			'type'=>'text',
			'filter'=>'',
			'width'=>300,
			'null'=>true,
		),
		'profession'=>array
		(
			'name'=>'行业',
			'type'=>'text',
			'filter'=>'',
			'width'=>300,
			'null'=>true,
		),
		'brief_intro'=>array
		(
			'name'=>'简介',
			'type'=>'richtext',
			'filter'=>'',
			'height'=>'300',
			'null'=>true,
		),
		
		
	),
	'audience' => array(
		'username' =>array
		(
			'name'=>'用户名',
			'type'=>'text',
			'null'=>false
		),
		'channels' =>array
		(
			'name'=>'所选栏目',
			'type'=>'text',
			'prefilter'=>'showChannelName',
			'null'=>false
		),
		'real_name' =>array
		(
			'name'=>'真实姓名',
			'type'=>'text',
			'null'=>false
		),
		'gender' =>array
		(
			'name'=>'性别',
			'type'=>'text',
			'prefilter' => 'showGender',
			'null'=>false
		),
		'birthday' =>array
		(
			'name'=>'出生年',
			'type'=>'text',
			'null'=>false
		),
		'company' =>array
		(
			'name'=>'单位/学校',
			'type'=>'text',
			'null'=>false
		),
		'mobile' =>array
		(
			'name'=>'手机',
			'type'=>'text',
			'null'=>false
		),
		'province' =>array
		(
			'name'=>'所在地',
			'type'=>'text',
			'prefilter' => 'showProvince',
			'null'=>false
		),
		
	),
	'businesscase' => array(
		'username' =>array
		(
			'name'=>'用户名',
			'type'=>'text',
			'null'=>false
		),
		'real_name' =>array
		(
			'name'=>'真实姓名',
			'type'=>'text',
			'null'=>false
		),
		'gender' =>array
		(
			'name'=>'性别',
			'type'=>'text',
			'prefilter' => 'showGender',
			'null'=>false
		),
		'company' =>array
		(
			'name'=>'单位/学校',
			'type'=>'text',
			'null'=>false
		),
		'mobile' =>array
		(
			'name'=>'手机',
			'type'=>'text',
			'null'=>false
		),
		'content' =>array
		(
			'name'=>'案例说明',
			'type'=>'text',
			'null'=>false
		),
		'file_url' =>array
		(
			'name'=>'案例附件',
			'type'=>'file',
			'null'=>false
		),
		
	),
);

//编辑之前，获得progrm与person的关联关系，并转换成嘉宾名字
function program_before_edit(&$data)
{
	if ($data['program_id'])
	{
		//获取 嘉宾名字
		$person = new Person;
		$data['persons'] = $person->get_persons_name($data['program_id'],'program');
		$data['persons'] = join(',',$data['persons']);
	}
}

//编辑后，写入数据库之前。暂存嘉宾名字，等待存入数据库之后处理。因为现在不知道 program_id
function program_after_edit(&$data)
{
	if ($data['persons']) define('PROGRAM_PERSONS',$data['persons']);
	unset($data['persons']);
}

//写入数据库之后，把刚刚暂存的嘉宾名字分割，存入person表，并建立关联关系
function program_after_db($data)
{
	if ($data['program_id'] && defined('PROGRAM_PERSONS'))
	{
		$person = new Person;
		$names = preg_replace('/(\s+|\,|，|。)/',',',PROGRAM_PERSONS);
		$name_arr = explode(',',$names);
		$person->set_persons($data['program_id'],'program',$name_arr);
	}
}

//
function video_before_edit(&$data)
{
	if ($data['video_id'])
	{
		//获取 嘉宾名字
		$person = new Person;
		$data['persons'] = $person->get_persons_name($data['video_id'],'video');
		$data['persons'] = join(',',$data['persons']);
		//获取 tag 名字
		$tag = new Tag;
		$data['tag'] = $tag->get_tags_name($data['video_id'],'video');
		$data['tag'] = join(',',$data['tag']);
	}
}

//编辑后，写入数据库之前
function video_after_edit(&$data)
{
	if ($data['persons']) define('VIDEO_PERSONS',$data['persons']);
	if ($data['tag']) define('VIDEO_TAGS',$data['tag']);
	
	unset($data['persons']);
	unset($data['tag']);
}

//写入数据库之后
function video_after_db($data)
{
	//更新嘉宾信息
	if ($data['video_id'] && defined('VIDEO_PERSONS'))
	{
		$person = new Person;
		$names = preg_replace('/(\s+|\,|，|。)/',',',VIDEO_PERSONS);
		$name_arr = explode(',',$names);
		$person->set_persons($data['video_id'],'video',$name_arr);
	}
	//更新tag信息
	if ($data['video_id'] && defined('VIDEO_TAGS'))
	{
		$tag = new Tag;
		$tags = preg_replace('/(\s+|\,|，|。)/',',',VIDEO_TAGS);
		$tag_arr = explode(',',$tags);
		$tag->updateTags($tag_arr,$data['video_id'],'video',$_SESSION['login_user']['admin_id']);
	}
}

//
function auction_before_edit(&$data)
{
	if ($data['auction_id'])
	{
		//获取 template
		$tmp = new AuctionTemplate;
		$data['template'] = $tmp->get_value($data['auction_id'],'content');
	}
}

//编辑后，写入数据库之前
function auction_after_edit(&$data)
{
	if ($data['template']) define('AUCTION_TEMPLATE',$data['template']);
	unset($data['template']);
}

//写入数据库之后
function auction_after_db($data)
{
	//更新嘉宾信息
	if ($data['auction_id'] && defined('AUCTION_TEMPLATE'))
	{
		$tmp = new AuctionTemplate;
		$tmp->delete($data['auction_id']);
		$tmp->add(
			array(
				'auction_id'=>$data['auction_id'],
				'content'=>AUCTION_TEMPLATE,
				'updated_by'=>$_SESSION['login_user']['admin_id']
			));
	}
}
