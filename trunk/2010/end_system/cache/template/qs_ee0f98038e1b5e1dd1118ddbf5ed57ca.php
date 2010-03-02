<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>静态页面管理 -  后台</title>
<base href="<?php echo $_obj['url_base']; ?>" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo $_obj['css']; ?>/admin.css" type="text/css" media="all" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo $_obj['css']; ?>/style.css" type="text/css" media="all" />
<script language="JavaScript" src="public/js/jquery/jquery.js" type="text/javascript"></script>
<script language="JavaScript" src="public/js/common.js" type="text/javascript"></script>
<script>
can_not_update = false;
can_not_delete = false;
can_not_add = false;
</script>
</head>


<body>
<div class='maindiv'>

	<div class="headerdiv">
		<div class='logo'>
</div>

	<div class='navi'>
		<ul>
			
			
            <?php

		$display_controllers = array(
			'item',
			'category',
			'admin',
			'user',
			'rights',
			'account',
			'config',
			'comment',
			'page',
			'personpreview',
			'auction'
		);
		foreach($display_controllers as $_p)
		{
			if (!$_SESSION['login_user']['allowed_controllers'][$_p]) continue;
			echo "<li><a  ";
			if (END_CONTROLLER == $_p) echo " class='navi_on' ";
			echo "href='admin.php?p={$_p}'>".lang('NAVI_'.$_p)."</a></li>";
		}
		?>
            
            <li><a href='admin.php?p=login&m=logout&module=admin&backurl=index.php'> 注销登陆</a></li>
            
		</ul>
	</div>
	<script>
	<?php if (!check_show('update')):?>
	can_not_update = true;
	<?php endif;?>
	</script>

	</div>
	
	<div id='contentdiv'>
		<div id='left'>
	    	<div style="margin:10px;margin-top:30px;">
				
	        	<ul>
	        	<?php if (check_show('add')) {?>
	                <li><a href="admin.php?p=page&add=1">增加页面</a></li>
	            <?php }?>
	            </ul>
	    		
	        </div>
	    </div>
	   
	    <div id='maindiv'>
	     <div class="description">
				页面管理
	        </div>
	         <?php if ($_obj['edit']){ ?>
	        <form id="editpage" method="post" action="admin.php?p=page&pageid=<?php echo $_obj['editpage']['page_id']; ?>&edit=1">
			        标题：&nbsp;&nbsp;&nbsp;<input id="title" name="title" value="<?php echo $_obj['editpage']['title']; ?>"></input> <br />
			   文件名： <input id="pagename" name="pagename" onblur="checkpagename()" type="hidden" value="<?php echo $_obj['editpage']['page_name']; ?>"></input>
			   <input id="pagename" name="pagename" onblur="checkpagename()" disabled="disabled" value="<?php echo $_obj['editpage']['page_name']; ?>"></input>例如：action.php 
			   <span id="notice" style="color:red"></span><br />
			   模板内容：<br />
			   <textarea id ="content" name="content" style="width:700px;height:400px;" ><?php echo $_obj['editpage']['content']; ?></textarea> <br />
			   <input id="fabu" type="submit" value="发布" onclick="return confirm('确定发布？')"></input><br />
	        </form>
	        <?php } elseif ($_obj['add']){ ?>
	        <form id="newpage" method="post" action="admin.php?p=page">
			        标题：&nbsp;&nbsp;&nbsp;<input id="title" name="title"></input> <br />
			   文件名：<input id="pagename" name="pagename" onblur="checkpagename()"></input>例如： action.php
			   <span id="notice" style="color:red"></span><br />
			   模板内容：<br />
			   <textarea id ="content" name="content"style="width:700px;height:400px;" ></textarea> <br />
			   <input id="fabu" type="submit" value="发布" onclick="return confirm('确定发布？')" disabled="disabled"></input><br />
	        </form>
	        <?php } else { ?>
	        <div class="real_content">
	        	
				<div style="text-align:center"><?php echo $_obj['pager']; ?></div>
	            
<table cellpadding="0" cellspacing="1" border="0" class="align_center list_table" id="admin_table">
            	<thead>
                   	<tr>
                		<th width="150" order="title">标题</th>
                        <th width="150" order="page_name">文件名</th>
                   		<th width="150" order="updated_on">更新日期</th>
                   		<th width="150" order="admin_name">更新用户</th>
                        <th width="100">操作</th>
                        
                    </tr>
                </thead>
                <tbody>
                
          		  	<?php if (!empty($_obj['pages'])){if (!is_array($_obj['pages']))$_obj['pages']=array(array('pages'=>$_obj['pages'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['pages'] as $rowcnt=>$pages) { $pages['ROWCNT']=($rowcounter); $pages['ALTROW']=$rowcounter%2; $pages['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$pages; ?>
            		<tr>
               		 	<td><?php echo $_obj['title']; ?></td>
               		 	<td><?php echo $_obj['page_name']; ?></td>
                        <td><?php echo preg_replace("/(^20)|(\:\d\d$)/","",$_obj['updated_on']);?></td>
                        <td><?php echo $_obj['admin_name']; ?></td>
                        <td>
                        <?php if ($_obj['status'] != "1"){ ?>
                        <a href="admin.php?p=page&edit=1&pageid=<?php echo $_obj['page_id']; ?>">编辑</a> 
                        <?php } ?>
                        <?php if ($_obj['status'] != "2"){ ?>
                        <a href="javascript:;" onclick="if(confirm('确认是否删除？'))delete_page(<?php echo $_obj['page_id']; ?>,this)">删除</a>
                        <?php } ?>
                        </td>
                       
               		</tr>
                    <?php } $_obj=$_stack[--$_stack_cnt];} ?>
                    
                </tbody>
                
</table>

<script>

function delete_page(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=page&delete=1&id='+id,{ },delete_callback);
	
}

function delete_callback(s)
{
	
		$('[to_be_delete=yes]').parent().parent().fadeOut();
		
}
</script>
				<div style="text-align:center"><?php echo $_obj['pager']; ?></div>
				
	        </div>
	        <?php } ?>
	    </div>
	</div>
<script>
function checkpagename(){
	var pagename = $('#pagename').val().replace(/^\s+|\s+$/g,'');
	if(pagename == ''){
		$('#notice').html("文件名不能为空！");
		$('#fabu').attr('disabled','disabled');
		}else{
			$.post('admin.php?p=page&check=1',{ pagename:pagename },function(data){
				if(data == 1){
					$('#notice').html("文件名不能重复！");
					$('#fabu').attr('disabled','disabled');
					}else{
						$('#notice').html("");
						$('#fabu').removeAttr('disabled');
						}
				});
			}
	
}
</script>	
	
	
	
	<div class="footer">
Copyright @ <a href="http://longbill.cn" target="_blank">Longbill</a> (<?php echo $_obj['time_used']; ?>s) (<?php echo $_obj['total_query']; ?>)
</div>
<script src="end_system/plugin/ckeditor/ckeditor.js"></script>
<script>
$(function()
{
	//是否启动点击编辑功能
	if (!can_not_update) load_admin();
	//替换富文本编辑框
	if ($('textarea[rich]').length > 0)
	{
	
		$('textarea[rich]').each(function()
		{
			CKEDITOR.replace( this.id,
			{
				height:$(this).height(),
				skin:'v2',
				width:$(this).width()
			});
		});
	}
	//处理排序
	var url = window.location.href.toString();
	$('th[order]').each(function()
	{
		var order = $(this).attr('order');
		var text = $(this).html();
		if (!order || !text) return;
		var extra = '';
		$(this).html('');
		//新的排序
		var new_url = url.replace(/\&(order|desc|asc)=\w+/ig,'').replace(/\&page=\d+/ig,'');
		new_url+= '&order='+order;
		
		var reg = new RegExp("order\="+order,"i");
		if (reg.test(url)) //如果是用当前排序
		{
			if (/asc\=true/.test(url)) //如果倒序
			{
				new_url += '&desc=true';
				extra = $('<img src="end_system/view/admin/images/asc.gif" />');
			}
			else
			{
				new_url += '&asc=true';
				extra = $('<img src="end_system/view/admin/images/desc.gif" />');
			}			
		}
		$(this).append($('<a href="'+new_url+'">'+text+'</a>')).append(extra);
	});
});
</script>

</div>
</body>
</html>