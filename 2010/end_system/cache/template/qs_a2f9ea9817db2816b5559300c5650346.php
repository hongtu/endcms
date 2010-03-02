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
			<?php if(check_show('add')){?>
        	<ul>
                <li><a href="javascript:new_admin();"> 新建用户</a></li>
            </ul>
    		<?php }?>
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
			<div class="nav_wrapper">
				&nbsp;显示:
				<a href="admin.php?p=admin"  class="nav <?php if ($_obj['rights_id'] == "-1"){ ?>nav_on<?php } ?>">所有角色</a>
				<a href="admin.php?p=admin&rights_id=0" class="nav <?php if ($_obj['rights_id'] == "0"){ ?>nav_on<?php } ?>">默认角色</a>
				<?php if (!empty($_obj['rights'])){if (!is_array($_obj['rights']))$_obj['rights']=array(array('rights'=>$_obj['rights'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['rights'] as $rowcnt=>$rights) { $rights['ROWCNT']=($rowcounter); $rights['ALTROW']=$rowcounter%2; $rights['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$rights; ?>
				<a href="admin.php?p=admin&rights_id=<?php echo $_obj['rights_id']; ?>" class="nav <?php if ($_obj['rights_id'] == $_stack[$_stack_cnt-1]['rights_id']){ ?>nav_on<?php } ?>"><?php echo $_obj['name']; ?></a>
				<?php } $_obj=$_stack[--$_stack_cnt];} ?>
			</div>
			
			<div id="new_admin" style="display:<?php if ($_obj['admin']){ ?><?php } else { ?>none<?php } ?>;margin:20px;background-color:#FFFF99;width:400px;">
            	<h2> 新建用户</h2>
        		        <form action="admin.php?m=new_admin&p=admin" method="post"  onsubmit="return check_form();" >
        	<table>

            	<tr>
                	<td> 用户名</td>
                	<td><input type="text" class="inputtext" maxlength=200 name="name" id='name' value="<?php echo $_obj['admin']['name']; ?>" />*</td>
               	</tr>
                
                <tr>
                	<td valign="top"> 密码</td>
                    <td><input type="password" class="inputtext" maxlength=200 name="password" id='password' /><?php if ($_obj['is_edit_admin']){ ?> 如果不修改请不要填写此项<?php } else { ?>*<?php } ?></td>
                </tr>
          
                <tr>
                	<td valign="top"> 确认</td>
                    <td><input type="password" class="inputtext" maxlength=200 name="password2" id='password2' /><?php if ($_obj['is_edit_admin']){ ?> 如果不修改请不要填写此项<?php } else { ?>*<?php } ?></td>
                </tr>
            	<tr>
                	<td> E-mail</td>
                	<td><input type="text" class="inputtext" maxlength=200 name="email" value="<?php echo $_obj['admin']['email']; ?>" /></td>
               	</tr>                
                <tr>
                	<td colspan="2" align="center">
                    	<input type="submit" value=" 提交" />&nbsp;
                    	<input type="button" value=" 取消" onclick="cancel_new_admin(); return false;" />
                    </td>
                </tr>
             </table>
             
                
           </form>

<script>
function check_form()
{
	<?php if (!$_obj['is_edit_admin']){ ?>
	if (!$_('password').value || !$_('name').value)
	{
		alert(' 请填写带*的项!');
		return false;
	}
	<?php } ?>
	if ($_('password').value != $_('password2').value)
	{
		alert(' 密码不一致！');
		return false;
	}
}
</script>
            </div>
            
<table cellpadding="0" cellspacing="1" border="0" class="align_center list_table" id="admin_table">
            	<thead>
                   	<tr>
                		<th width="30%"> 用户名</th>
                        <th width="10%"> 密码</th>
                   		<th width="30%"> E-mail</th>
                        <th width="10%"> 角色</th>
                        <th width="20%"> 操作</th>
                    </tr>
                </thead>
                <tbody>
                
          		  	<?php if (!empty($_obj['admins'])){if (!is_array($_obj['admins']))$_obj['admins']=array(array('admins'=>$_obj['admins'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['admins'] as $rowcnt=>$admins) { $admins['ROWCNT']=($rowcounter); $admins['ALTROW']=$rowcounter%2; $admins['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$admins; ?>
            		<tr>
               		 	<td><?php echo $_obj['name']; ?></td>
                        <td><div onclick="change_password(event,'<?php echo $_obj['name']; ?>',<?php echo $_obj['admin_id']; ?>)" class="change_password" style="cursor:pointer;text-align:center"> 修改</div></td>
               		    <td><div admin_type="text"
                        	admin_para="m=update&table=admin&column=email&id=<?php echo $_obj['admin_id']; ?>" 
                            admin_button="no" 
                            admin_trigger="click"><?php echo $_obj['email']; ?></div>
                        </td>
                        
                        <td>
							<div admin_type="text"
			              	admin_para="m=update&table=admin&column=rights_id&id=<?php echo $_obj['admin_id']; ?>" 
			                    admin_select_value="<?php echo $_obj['rights_id']; ?>"
			                    admin_select_source_id="rights_select"
			                    admin_trigger="click"
								><?php echo $_obj['rights_group_name']; ?></div>
						</td>
                        <td>
							<?php if(check_show('delete')):?>
                        	<a href="javascript:;" onclick="if (confirm(' 你确认要删除此用户?')) delete_admin(<?php echo $_obj['admin_id']; ?>,this);"> 删除</a>
							<?php endif;?>
                        </td>
               		</tr>
                    <?php } $_obj=$_stack[--$_stack_cnt];} ?>
                    
                </tbody>
                
</table>
<div style="display:none">
<select id="rights_select">
	<option value="0">默认角色</option>
	<?php if (!empty($_obj['rights'])){if (!is_array($_obj['rights']))$_obj['rights']=array(array('rights'=>$_obj['rights'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['rights'] as $rowcnt=>$rights) { $rights['ROWCNT']=($rowcounter); $rights['ALTROW']=$rowcounter%2; $rights['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$rights; ?>
	<option value="<?php echo $_obj['rights_id']; ?>"><?php echo $_obj['name']; ?></option>
	<?php } $_obj=$_stack[--$_stack_cnt];} ?>
</select>
</div>
			<br />
			<?php echo $_obj['pager']; ?>
        </div>
        
    </div>
</div>

<div id="change_password" style="display:none;position:absolute;background-color:#FFFF99;width:200px;">
        	 <table>
             	<tr>
                	<td valign="top"> 用户名</td>
                    <td><input type="text" class="inputtext" style="width:100px;" id='change_password_admin' disabled="disabled" /></td>
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
<?php if(check_show('update')):?>
$('.change_password').bind('mouseover',function()
{
	$(this).addClass('text_mouseover'); 
}); 

$('.change_password').bind('mouseout',function(){ $(this).removeClass('text_mouseover'); });
<?php endif;?>
function change_password(event,name,id)
{
	$('#change_password_admin').val(name);
	$('[password]').val('').attr('admin_id',id);
	$('#change_password')
		.css( { left:event.clientX+$(document).scrollLeft(),top:event.clientY+$(document).scrollTop() } )
		.slideDown(200);
}

function do_change_password()
{
	if ($('[password=1]').val() != $('[password=2]').val())
	{
		alert(' 密码不一致！');
		return;
	}
	else
	{
		var p = $('[password=1]');
		$.post("admin.php?p=ajax&m=update_password&table=admin&id="+p.attr('admin_id'),{ value:p.val()},change_password_callback);
	}
}

function change_password_callback(s)
{
	if (s == 'success')
	{
		alert(' 更新成功');
	}
	else
	{
		alert(s);
	}
	$('#change_password').slideUp(200);
}

function delete_admin(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=delete&table=admin&id='+id,{ },delete_callback);
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

function new_admin()
{
	$('#new_admin').fadeTo(10,0).slideDown(200).fadeTo('fast',1);
}

function cancel_new_admin()
{
	$('#new_admin').fadeTo('fast',0).slideUp(200);
}
<?php if (!$_SESSION['login_user']['rights']['admin_update']) {?>
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