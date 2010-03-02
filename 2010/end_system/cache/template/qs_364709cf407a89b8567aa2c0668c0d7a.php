<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> 栏目管理 -  后台</title>
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

<div id='content' style="margin:0px;padding:0px;">
	<div id='left' onselectstart="return false;">
        	<div style="margin:4px;margin-top:10px;">
	        	<h2>栏目管理</h2>
				<div id="category_tree">
					<ul>
						<li><a href="admin.php?p=category" <?php if ($_obj['category_id'] == "0"){ ?>class="tree_on" <?php } ?> > 根栏目</a></li>
						<li><?php echo $_obj['all_category']; ?></li>
					</ul>
				</div>
	        </div>
    </div>
    <div id='maindiv'>
    	<div class="description">
			<?php echo $_obj['page_description']; ?>
        </div>
		<div class="position">
			当前位置: 栏目管理 > <a href="admin.php?p=category"> 根栏目</a> > 
			<?php if (!empty($_obj['position'])){if (!is_array($_obj['position']))$_obj['position']=array(array('position'=>$_obj['position'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['position'] as $rowcnt=>$position) { $position['ROWCNT']=($rowcounter); $position['ALTROW']=$rowcounter%2; $position['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$position; ?>
			 <a href="admin.php?p=category&category_id=<?php echo $_obj['category_id']; ?>"><?php echo $_obj['name']; ?></a> > 
			<?php } $_obj=$_stack[--$_stack_cnt];} ?>
			<?php echo $_obj['this_category']['name']; ?>
		</div>
		
		<?php if (!$_obj['page_content']){ ?>
		<div class="nav_wrapper">
			&nbsp;可用操作:
			<?php if (check_show('add')):?>
				
				<a class="nav" href="javascript:new_category()" id='new_category_a'>
					添加子栏目
				</a>
			<?php endif;?>
			<?php if (check_show('update')):?>
				<a class="nav" href="admin.php?p=category&action=edit_category&category_id=<?php echo $_obj['category_id']; ?>" >
					编辑此栏目
				</a>
			<?php endif;?>
			
		</div>
		<?php } ?>
		
        <?php if ($_obj['err_msg']){ ?>
        <div class="err_msg pad">
        	<?php echo $_obj['err_msg']; ?>
        </div>
        <?php } ?>
        
        <?php if ($_obj['success_msg']){ ?>
        <div class="success_msg pad">
        	<?php echo $_obj['success_msg']; ?>
        </div>
        <?php } ?>
        
        <div class="real_content">
        	<?php if ($_obj['page_content']){ ?>
				<?php echo $_obj['page_content']; ?>
			<?php } else { ?>
	        	<div id="new_category" style="display:<?php if ($_obj['category']){ ?><?php } else { ?>none<?php } ?>;margin:20px;background-color:#FFFF99;width:400px;">
	            	<h2> 新建栏目</h2>
	        				<form action="admin.php?m=new_category&p=category&category_id=<?php echo $_obj['category_id']; ?>" method="post">
        	<table cellpadding="0" cellspacing="5" border="0" style="width:400px;">
            	<tr>
                	<td> 栏目名称</td>
                	<td><input type="text" class="inputtext" maxlength=200 name="name" value="<?php echo $_obj['category']['name']; ?>" />*</td>
               	</tr>
            	
                <tr>
                	<td>&nbsp;</td>
                	<td align="center">
                    <input type="submit" value=" 提交" />
                    &nbsp;
                    <input type="button" onclick="cancel_new_category(); return false;" value=" 取消" />
                    </td>
                </tr>
             </table>
             
                
           </form>

	            </div>
	            <table cellpadding="0" cellspacing="0" border="0" class="align_center list_table" id="category_table" style="width:auto">
            	<thead>
                   	<tr>
                		<th style="width:50px;"> 优先级</th>
                		<th style="width:120px;"> 栏目名称</th>
                   		<th style="width:200px;">URL</th>
                   		<th style="width:70px;">类型</th>
						<?php if ($_obj['debug']){ ?>
						<th style="width:30px;">锁定</th>
						<th style="width:70px;">Alias</th>
						<?php } ?>
                        <th style="width:150px;"> 操作</th>
                    </tr>
                </thead>
                <tbody>
                
          		  	<?php if (!empty($_obj['categories'])){if (!is_array($_obj['categories']))$_obj['categories']=array(array('categories'=>$_obj['categories'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['categories'] as $rowcnt=>$categories) { $categories['ROWCNT']=($rowcounter); $categories['ALTROW']=$rowcounter%2; $categories['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$categories; ?>
						<?php	if($_obj['system'] && END_DEBUG !='yes'){?>
            				<tr>
		               		 	<td><div admin_type="text"
		                        	admin_para="m=update&table=category&column=order_id&id=<?php echo $_obj['category_id']; ?>" 
									style="text-align:center"><?php echo $_obj['order_id']; ?></div></td>
		               		 	<td><?php echo $_obj['name']; ?></td>
		               		    <td><?php echo $_obj['description']; ?></td>
								<td><?php
echo show_status($_obj['status']);
?></td>
		                        <td>
									<a href="admin.php?p=category&category_id=<?php echo $_obj['category_id']; ?>">子栏目</a> 
		                          	<?php
									if (check_show('update')):?>
		                          	<a href="javascript:edit_page(<?php echo $_obj['category_id']; ?>);"> 编辑</a> 
									<?php endif;?>
		                        </td>
		               		</tr>
						<?php }else{ ?>
							<tr>
		               		 	<td><div admin_type="text"
		                        	admin_para="m=update&table=category&column=order_id&id=<?php echo $_obj['category_id']; ?>" 
									style="text-align:center"><?php echo $_obj['order_id']; ?></div></td>
		               		 	<td><div admin_type="text"
		                        	admin_para="m=update&table=category&column=name&id=<?php echo $_obj['category_id']; ?>"><?php echo $_obj['name']; ?></div></td>
		               		    <td><div admin_type="text" 
		                        	admin_para="m=update&table=category&column=url&id=<?php echo $_obj['category_id']; ?>"><?php echo $_obj['url']; ?></div>
		                        </td>
								<td>
									<div admin_type="text"
					              	admin_para="m=update&table=category&column=status&id=<?php echo $_obj['category_id']; ?>" 
					                    admin_select_value="<?php echo $_obj['status']; ?>"
					                    admin_select_source_id="status_select"
					                    admin_trigger="click" status_category_id="<?php echo $_obj['category_id']; ?>"
										><?php
echo show_status($_obj['status']);
?></div>
								</td>
								<?php if ($_stack[$_stack_cnt-1]['debug']){ ?>
								<td>
									<div admin_type="text"
					              	admin_para="m=update&table=category&column=system&id=<?php echo $_obj['category_id']; ?>" 
					                    admin_select_value="<?php echo $_obj['system']; ?>"
					                    admin_select_source_id="category_system_select"
					                    admin_trigger="click" status_category_id="<?php echo $_obj['category_id']; ?>"
										><?php echo $_obj['system']; ?></div>
								</td>
								<td>
									<div admin_type="text"
					              	admin_para="m=update&table=category&column=alias&id=<?php echo $_obj['category_id']; ?>" 
					                    admin_trigger="click"
										><?php echo $_obj['alias']; ?></div>
								</td>
								<?php } ?>
		                        <td>
									<a href="admin.php?p=category&category_id=<?php echo $_obj['category_id']; ?>">子栏目</a> 
		                          	<?php if (check_show('delete')):?>
									<a href="javascript:;" onclick="if (confirm(' 确定要执行删除操作吗?')) delete_category(<?php echo $_obj['category_id']; ?>,this);"> 删除</a> 
									<?php endif;
									if (check_show('update')):?>
		                          	<a href="javascript:edit_page(<?php echo $_obj['category_id']; ?>);"> 编辑</a> 
									<?php endif;?>
									<!-- a href="index.php?p=category&category_id=<?php echo $_obj['category_id']; ?>" target="_blank">预览</a-->
		                        </td>
		               		</tr>
						<?php } ?>
                    <?php } $_obj=$_stack[--$_stack_cnt];} ?>
                    
                </tbody>
                
</table>

<script>
function edit_page(id)
{
	var o = $('[status_category_id='+id+']');
	if (o.attr('admin_select_value') == '1')
	{
		alert('不能编辑文章列表栏目');
	}
	else
	{
		window.location.href = "admin.php?p=category&action=edit_category&category_id="+id;
	}
}
</script>

<div style="display:none">
<select id="status_select">
	<?php if (!empty($_obj['statuses'])){if (!is_array($_obj['statuses']))$_obj['statuses']=array(array('statuses'=>$_obj['statuses'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['statuses'] as $rowcnt=>$statuses) { $statuses['ROWCNT']=($rowcounter); $statuses['ALTROW']=$rowcounter%2; $statuses['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$statuses; ?>
	<option value="<?php echo $_obj['index']; ?>"><?php echo $_obj['value']; ?></option>
	<?php } $_obj=$_stack[--$_stack_cnt];} ?>
</select>
</div>
<div style="display:none">
<select id="category_system_select">
	<option value="0">0</option>
	<option value="1">1</option>
</select>
</div>
			<?php } ?>
			<br />
        </div>
    
    </div>
	<div style="clear:both;"></div>
</div>
<script>
$(function()
{
	var root = $('#category_tree').children('ul');
	root.find('li').each(function()
	{
		var li = $(this);
		if (li.children('a').length > 0)
		{
			if (li.next('li').children('ul').children('li').length > 0 )
			{
				$('<img src="end_system/view/admin/images/plus.png" border="0" class="expand_button" />')
				.click(function()
				{
					var exp_bt = this;
					li.next('li').slideToggle(300,function()
					{
						$(exp_bt).attr('src',$(this).is(':visible')?'end_system/view/admin/images/minus.png':'end_system/view/admin/images/plus.png');
					});
					
				}).prependTo(li);
			}
			else
			{
				$('<span class="expand_button"></span>').prependTo(li);
			}
		}
		else if (li.children('ul').length > 0)
		{
			li.hide();
		}
	});
	root.parent().show();
	var tree_on = root.find('a.tree_on');
	tree_on.parent('li').find('.expand_button').attr('src','end_system/view/admin/images/minus.png');
	if (tree_on.length > 0)
	{
		var li = tree_on.parents('li').show();
		li.next('li').show();
		while(li.parents('li').length > 0)
		{
			li = li.parents('li');
			li.show();
			li.prev('li').find('.expand_button').attr('src','end_system/view/admin/images/minus.png');
		}
	}
});
function delete_category(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=delete&table=category&id='+id,{ },delete_callback);
}
function delete_callback(s)
{
	if (s != 'success')
	{
		alert('DELETE_ERROR');
		return false;
	}
	$('[to_be_delete=yes]').parent().parent().fadeOut();
}
function new_category()
{
	$("#new_category_a").addClass('nav_on');
	$('#new_category').fadeTo(10,0).slideDown(200).fadeTo('fast',1);
}
function cancel_new_category()
{
	$("#new_category_a").removeClass('nav_on');
	$('#new_category').fadeTo('fast',0).slideUp(200);
}
function change_category(o)
{
	if ($(o).val())
	{
		window.location = "admin.php?p=category&category_id="+ $(o).val();
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