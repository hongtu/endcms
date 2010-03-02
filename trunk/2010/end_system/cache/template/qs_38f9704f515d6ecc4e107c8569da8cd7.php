<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> 内容管理 -  后台</title>
<base href="<?php echo $_obj['url_base']; ?>" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo $_obj['viewroot']; ?>css/admin.css" type="text/css" media="all" />
<link rel="stylesheet" rev="stylesheet" href="<?php echo $_obj['viewroot']; ?>css/style.css" type="text/css" media="all" />
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
        	<h2>栏目</h2>
			<div id="category_tree" style="display:none">
				<ul>
					<li><a href="admin.php?p=item" <?php if ($_obj['category_id'] == "0"){ ?>class="tree_on" <?php } ?> > 根栏目</a></li>
					<li><?php echo $_obj['all_category']; ?></li>
				</ul>
			</div>
        </div>
    </div>
    <div id='maindiv'>
    	<div class="description">
			<?php echo $_obj['page_description']; ?>
        </div>
		
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
		<br />
        <?php } else { ?>
			<div class="position">
				当前位置: 内容管理 > <a href="admin.php?p=item">根栏目</a> > 
				<?php if (!empty($_obj['position'])){if (!is_array($_obj['position']))$_obj['position']=array(array('position'=>$_obj['position'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['position'] as $rowcnt=>$position) { $position['ROWCNT']=($rowcounter); $position['ALTROW']=$rowcounter%2; $position['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$position; ?>
				 <a href="admin.php?p=item&category_id=<?php echo $_obj['category_id']; ?>"><?php echo $_obj['name']; ?></a> > 
				<?php } $_obj=$_stack[--$_stack_cnt];} ?>
			</div>
			<?php if ($_obj['this_category']['is_list']){ ?>
				<?php if ($_obj['category_id']){ ?>
				<div class="nav_wrapper">
					&nbsp;功能:
					<?php if(check_show('add')){?>
					<a class="nav" href="admin.php?p=item&action=new_item&category_id=<?php echo $_obj['category_id']; ?>"> 添加内容</a>
					<?php };?>
				</div>
				<?php } ?>
				<div class="nav_wrapper">
					&nbsp;显示:
					<a 
						href="admin.php?p=item&category_id=<?php echo $_obj['category_id']; ?>"  
						class="nav <?php if ($_obj['current_status_all']){ ?>nav_on<?php } ?>">所有</a>
					<?php if (!empty($_obj['statuses'])){if (!is_array($_obj['statuses']))$_obj['statuses']=array(array('statuses'=>$_obj['statuses'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['statuses'] as $rowcnt=>$statuses) { $statuses['ROWCNT']=($rowcounter); $statuses['ALTROW']=$rowcounter%2; $statuses['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$statuses; ?>
					<a 
						href="admin.php?p=item&status=<?php echo $_obj['index']; ?>&category_id=<?php echo $_stack[$_stack_cnt-1]['category_id']; ?>" 
						class="nav <?php if ($_obj['index'] == $_stack[$_stack_cnt-1]['status']){ ?>nav_on<?php } ?>"><?php
echo strip_tags($_obj['value']);
?></a>
					<?php } $_obj=$_stack[--$_stack_cnt];} ?>
				</div>
			
				<?php echo $_obj['list_content']; ?>
			
			<?php } else { ?>
				<?php if ($_obj['category_id']){ ?>
				此栏目不是一个列表型栏目，要编辑此栏目内容<a href="admin.php?p=category&action=edit_category&category_id=<?php echo $_obj['category_id']; ?>">请点击这里</a>
				<?php } ?>
			<?php } ?>
        <?php } ?>
	<br />
        </div>
        <br />
    </div>
	<div style="clear:both;"></div>
</div>

<script type="text/javascript">
$(function()
{
	var root = $('#category_tree').children('ul');
	root.parent().show();
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
	
	root.find('a.status_folder').click(function(event)
	{
		event.preventDefault();
		$(this).prev().trigger('click');
		return false;
	});
	
});


function delete_item(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=delete&table=<?php echo $_obj['table']; ?>&id='+id,{ },delete_callback);
}
function delete_callback(s)
{
	if (s == 'error')
	{
		alert('DELETE_ERROR');
		return false;
	}
	$('[to_be_delete=yes]').parent().parent().fadeOut();
}
function change_category(o)
{
	if ($(o).val())
	{
		window.location = "admin.php?p=item&category_id="+ $(o).val();
	}
}

function change_status(id,value,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=update&column=status&table=<?php echo $_obj['table']; ?>&id='+id,{ value:value },function(s)
	{
		if (parseInt(s) != s)  alert(s);
		else
			delete_callback();
	});
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