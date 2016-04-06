# 配置文件出现的位置 #

> `end_ModuleName/model/ModelName/ModelName.config.php`
其中 ModuleName 为模块名子，比如 end\_blog或者 end\_news等; ModelName为模型名称。比如： end\_blog/model/link/link.config.php

# 此文件中必须提供的数据 #

```
<?php
/*
* 模型字段配置
*/
$end_models['ModelName'] = array(
	/*
	* 下面这行表明此数据模型对应数据库的一个数据表，因为有些数据模型用系统的栏目表(category)就可以完成(比如链接和页面等)
	*/
	'type' => 'list', 
	
	
	/*
	* 一个模型配置好之后，可以设置一个或者多个栏目的类型为此模型，所以这个模型要有个名称。比如：文章列表，会员数据列表等
	* 允许html标签，比如 <span style="color:red">文章列表</span>
	*/
	'name' => '使用此模型的栏目类型名称',	 
	
	
	
	/*
	* 是否使用系统的分类。 如果是true，那么与此模型对应的数据表里必须有 category_id 字段。
	* 有些数据是不需要分类的，比如留言本的数据
	*/
	'no_category'=>false,
	
	
	/*
	* 后台列表每页显示多少条 ， 默认是20条
	*/
	'list_items'=>20,

	
	
	/*
	* 使用此模型的栏目需要编辑的字段
	* category 的字段 你可以配置成不同的名称。 参考 end_admin/config.php 里面的 $end_model['page']
	*/
	'category_fields'=> array(
		'name'=>array(
			'name'=>'栏目标题',
			'type'=>'text',
			'null'=>false
		),
		...
	),


	/*
	* 此模型需要在后台编辑的字段。
	*/
	'fields' => array(  
		
		/*
		* column_name 对应数据库表的字段
		*/
		'column_name'=>array(
			/*
			* 后台编辑界面显示的字段名称
			*/ 
			'name'=>'字段名称',  
			
			/*
			* 输入类型，默认为text
			* 可选的有：
			*  textarea 文本段落输入 
			*  richtext 富文本编辑器 ( ckeditor )
			*  select 下拉选择 ( 必须同时配置 options 属性 )
			*  checkbox 是否选择框
			*  file 上传文件 ( 配合 filetype 和 saveto 属性 )
			*  image 上传图片 ( 配合 resize 和 saveto 属性 )
			*  datetime 时间输入，后台的字段必须为 int 11类型，因为保存的是unix时间戳
			*  具体的示例在下面
			*/
			'type'=>'input_type', 
			
			
			/*
			* 是否允许为空，如果不允许为空，那么后台编辑的时候会显示红色的*
			*/
			'null'=>false, 		
			
			
			/*
			* 输入框宽度
			*/
			'width'=>100, 
			
			/*
			* 输入框高度
			* 一般不用指定高度，除非大型输入类型，比如textarea, richtext 等
			*/
			'height'=>100, 
			
			/*
			* 数据在后台提交后，存入数据库前的过滤函数名。 
			*/
			'filter'=>'filter_function_name',
			
			/*
			* 数据从数据库读出来后，显示到编辑界面之前的过滤函数
			*/
			'prefilter'=>'prefilter_function_name',
			
			
			/*
			* 上传文件保存到什么地方，默认是 end_system/config.php里面配置的 END_UPLOAD_DIR
			*/
			'saveto'=>'save_to_path',
			
			
			/*
			* 允许上传的文件类型，小写
			*/
			'filetype'=>array('jpg','jpeg','gif','doc','zip'),
			
			/*
			* 如果类型是image，那么可以通过resize属性指定图片上传后被调整为各种尺寸，不用担心比例问题。因为我们采用了居中裁剪的方式。
			* 重要！ resize 对应的是一个array，此array里面的元素仍然是 array。所以不能这样：'resize'=>array('width'=>100 ... )!!!!
			*/
			'resize'=>array(
				array(
					'width'=>100,
					'height'=>200,
					/*
					* 调整尺寸后的图片的地址保存到数据库的什么字段
					* 这个属性不是必须的。因为图片被调整尺寸后的文件名是原始文件名后面加100x200.jpg，例如:  public/2010/04/aaa.png100x300.jpg
					*/
					'saveas'=>'small_pic'
				),
				array(
					'width'=>200,
					'height'=>400
				)
			),
			
		),
		...
	),


	/*
	* 后台列表显示的字段
	*/
	'list_fields' => array(
		
		/*
		* column_name 对应数据库表的字段
		*/
		'column_name'=>array(
			/*
			* name 是 列表的表头
			*/
			'name'=>'ID',
			
			/*
			* 此列有多宽,可以是'auto'
			*/
			'width'=>'30',
			
			/*
			* 此列是否可以排序
			*/
			'sort'=>true,
			
			/*
			* 内容显示的对其方式
			*/
			'align'=>'center',
			
			/*
			* 是否可以直接在列表里编辑
			*/
			'edit'=>true,
			
			/*
			* 是否可以用 LIKE 方式 搜索
			*/ 
			'search'=>true,
		),
		...
	)
);

/*
* 模型权限配置
*/
$end_rights[] = array(
	'name'=>'ModelName',
	'description'=>'权限名字',
	'rights'=>array('view','add','update','delete')
);

```