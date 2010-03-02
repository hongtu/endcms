<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> 管理用户 -  后台</title>
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
	<script src="end_system/view/admin/jquery/ui.datepicker.js" ></script>
	<script src="end_system/view/admin/jquery/ui.datepicker-zh-CN.js"></script>
	<link rel="stylesheet" href="end_system/view/admin/jquery/ui.datepicker.css" media="screen" />
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

			<div style="margin:10px;">
				<h2>注册时间</h2>
			从<input type="text" id="date_from" class="textinput" value="<?php echo $_obj['from']; ?>" style="width:100px;font-size:10px;" /> <br />
			到<input type="text" id="date_to" class="textinput" style="width:100px;font-size:10px;" value='<?php echo $_obj['to']; ?>' /><br />
			&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="go_time_range()" value="搜索" />
			</div>

			<div style="margin:10px;">
				<h2>内容</h2>
				<form onsubmit="go_search();return false;">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>用户名</td>
						<td><input type="text" id="search_username" class="textinput" style="width:100px;" value="<?php echo $_obj['search_username']; ?>" /></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" id="search_email" class="textinput" style="width:100px;"  value="<?php echo $_obj['search_email']; ?>" /></td>
					</tr>
					<tr>
						<td colspan="2">
							&nbsp;&nbsp;<input type="submit" value="搜索" />&nbsp;&nbsp;
						</td>
					</tr>
				</table>
				</form>
			</div>

			<script>
			$(function()
			{
				$("[id^=date_]").datepicker();
			});

			function go_time_range()
			{
				var from = $('#date_from').val();
				var to = $('#date_to').val();
				var url = window.location.href.toString();
				url = url.replace(/&from=[^&]+/,'').replace(/&time=[^&]+/,'').replace(/&to=[^&]+/,'');
				if (from && to && from > to)
				{
					alert("起始时间必须小于结束时间");
					return;
				}
				else
				{
					window.location.href = url+"&from="+from+"&to="+to;
				}
			}

			function go_search()
			{
				var url = window.location.href.toString();
				url = url.replace(/&search_username=[^&]+/,'').replace(/&search_email=[^&]+/,'');
				if($('#search_username').val()) url+='&search_username='+encodeURIComponent($('#search_username').val());
				if ($('#search_email').val()) url+='&search_email='+encodeURIComponent($('#search_email').val());
				window.location.href = url;
			}
			</script>
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
			<?php } else { ?>
			<div class="nav_wrapper">
				&nbsp;显示:
				<a 
					href="admin.php?p=user"  
					class="nav <?php if ($_obj['current_status_all']){ ?>nav_on<?php } ?>">所有</a>
				<?php if (!empty($_obj['statuses'])){if (!is_array($_obj['statuses']))$_obj['statuses']=array(array('statuses'=>$_obj['statuses'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['statuses'] as $rowcnt=>$statuses) { $statuses['ROWCNT']=($rowcounter); $statuses['ALTROW']=$rowcounter%2; $statuses['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$statuses; ?>
				<a 
					href="admin.php?p=user&status=<?php echo $_obj['index']; ?>" 
					class="nav <?php if ($_obj['index'] == $_stack[$_stack_cnt-1]['status']){ ?>nav_on<?php } ?>"><?php
echo strip_tags($_obj['value']);
?></a>
				<?php } $_obj=$_stack[--$_stack_cnt];} ?>
				
			</div>
            
<table cellpadding="0" cellspacing="1" border="0" class="align_center list_table" id="user_table">
            	<thead>
                   	<tr>
                		<th order="username"> 用户名</th>
                   		<th width="30%" order="email"> E-mail</th>
						<th width="20%" order="created_at">注册日期</th>
						<th width="50" order="status">状态</th>
                        <th width="20%"> 操作</th>
                    </tr>
                </thead>
                <tbody>
                
          		  	<?php if (!empty($_obj['users'])){if (!is_array($_obj['users']))$_obj['users']=array(array('users'=>$_obj['users'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['users'] as $rowcnt=>$users) { $users['ROWCNT']=($rowcounter); $users['ALTROW']=$rowcounter%2; $users['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$users; ?>
            		<tr>
               		 	<td><?php echo $_obj['username']; ?></td>
               		    <td><div><?php echo $_obj['email']; ?></div></td>
						<td><?php echo preg_replace("/\:\d\d$/","",$_obj['created_at']);?></td>
						<td><div admin_type="text"
		              	admin_para="m=update&table=user&column=status&id=<?php echo $_obj['user_id']; ?>" 
		                    admin_select_value="<?php echo $_obj['status']; ?>"
		                    admin_select_source_id="status_select"
		                    admin_trigger="click"
							><?php
echo show_status($_obj['status']);
?></div></td>
                        <td>
							<?php if(check_show('update')):?>
                        	<a href="admin.php?p=user&action=edit_user&user_id=<?php echo $_obj['user_id']; ?>" > 编辑</a>
							<?php endif;?>
                        </td>
               		</tr>
                    <?php } $_obj=$_stack[--$_stack_cnt];} ?>
                    
                </tbody>
                
</table>

<div style="display:none">
<select id="status_select">
	<?php if (!empty($_obj['statuses'])){if (!is_array($_obj['statuses']))$_obj['statuses']=array(array('statuses'=>$_obj['statuses'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['statuses'] as $rowcnt=>$statuses) { $statuses['ROWCNT']=($rowcounter); $statuses['ALTROW']=$rowcounter%2; $statuses['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$statuses; ?>
	<option value="<?php echo $_obj['index']; ?>"><?php echo $_obj['value']; ?></option>
	<?php } $_obj=$_stack[--$_stack_cnt];} ?>
</select>
</div>
			<br />
			<?php echo $_obj['pager']; ?>
			<?php } ?>
        </div>
        
    </div>
</div>

<div id="change_password" style="display:none;position:absolute;background-color:#FFFF99;width:200px;">
        	 <table>
             	<tr>
                	<td valign="top"> 用户名</td>
                    <td><input type="text" class="inputtext" style="width:100px;" id='change_password_user' disabled="disabled" /></td>
                </tr>
                <tr>
                	<td valign="top"> 密码</td>
                    <td><input type="password" class="inputtext" password="1"  style="width:100px;" /></td>
                </tr>
          
                <tr>
                	<td valign="top"> 确认</td>
                    <td><input type="password" class="inputtext" password="2"  style="width:100px;" /></td>
                </tr>
                <tr>
                	<td colspan="2" align="center">
                    	<input type="button" value=" 提交" onclick="do_change_password(); return false;" />
                        <input type="button" value=" 取消" onclick="$('#change_password').slideUp(200); return false;" />
                    </td>
                </tr>
             </table>
</div>


<script>

function delete_user(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=delete&table=user&id='+id,{ },delete_callback);
}

function delete_callback(s)
{
	if (s != 'success')
	{
		alert(s);
		return false;
	}
	$('[to_be_delete=yes]').parent().parent().fadeOut();
}

<?php if (!$_SESSION['login_user']['rights']['user_update']) {?>
can_not_update = true;
<?php }?>
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