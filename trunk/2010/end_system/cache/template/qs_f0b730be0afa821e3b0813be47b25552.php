<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title> 系统设置 -  后台</title>
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
<div class='main'>

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

<div id='content'>
	<div id='left'>
    	<div style="margin:10px;margin-top:30px;">
        	<ul>
				<?php if (check_show('add') && END_DEBUG == 'yes'):?>
				<li>
					<a href="javascript:new_config()"> 新建设置项</a>
				</li>
				<?php endif;?>
            </ul>
    		
        </div>
    </div>
    <div id='maindiv'>
    	<div class="description">
			<?php echo $_obj['page_description']; ?>
        </div>
        
        <div class="real_content">
		
			<div id="new_config" style="display:<?php if ($_obj['thisconfig']){ ?><?php } else { ?>none<?php } ?>;margin:20px;background-color:#FFFF99;width:400px;">
            	<h2> 新建设置</h2>
        		<form action="admin.php?m=new_config&p=config" method="post">
	<table cellpadding="0" cellspacing="5" border="0" style="width:400px;">
    	<tr>
        	<td> 变量名</td>
        	<td><input type="text" class="inputtext" maxlength=200 name="name" value="<?php echo $_obj['thisconfig']['name']; ?>" />*</td>
       	</tr>

        <tr>
        	<td valign="top"> 描述</td>
            <td><input type="text" name="description" class="inputtext" value="<?php echo $_obj['thisconfig']['description']; ?>" />*</td>
        </tr>
        <tr>
        	<td valign="top"> 类型</td>
            <td><select name="type">
            	<option value="text"> 单行文本</option>
            	<option value="textarea"> 多行文本</option>
            </select></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td align="center">
            <input type="submit" value=" 提交" />
            &nbsp;
            <input type="button" onclick="cancel_new_config(); return false;" value=" 取消" />
            </td>
        </tr>
     </table>
     
        
   </form>

            </div>
		<?php if ($_obj['debug']){ ?>
		<input type="checkbox" onclick="$('[configname=name]').css('display',this.checked?'block':'none');" /> 显示变量名
       	<br />
		<?php } ?>
		<table cellpadding="0" cellspacing="0" border="0" class="list_table" style="width:750px;">
			<tr>
        		<th style="width:7%"> 优先级</th>
        		<th style="width:35%"> 变量名</th>
                <th style="width:35%"> 值</th>
				<?php if ($_obj['debug']){ ?>
                <th style="width:23%"> 操作</th>
				<?php } ?>
            </tr>
			<?php if (!empty($_obj['config_list'])){if (!is_array($_obj['config_list']))$_obj['config_list']=array(array('config_list'=>$_obj['config_list'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['config_list'] as $rowcnt=>$config_list) { $config_list['ROWCNT']=($rowcounter); $config_list['ALTROW']=$rowcounter%2; $config_list['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$config_list; ?>
			<tr>
				<td valign="top">
					<div admin_type="text"
                	admin_para="m=update&table=config&column=order_id&id=<?php echo $_obj['config_id']; ?>"  
                    admin_trigger="click" style="text-align:center"><?php echo $_obj['order_id']; ?></div>
				</td>
				<td valign="top">
					<?php if ($_stack[0]['debug']){ ?>
					<div configname="name"  admin_type="text"
            		admin_para="m=update&table=config&column=name&id=<?php echo $_obj['config_id']; ?>"  
                	admin_trigger="click" style="display:none"><?php echo $_obj['name']; ?></div>
					<div admin_type="text"
	            	admin_para="m=update&table=config&column=description&id=<?php echo $_obj['config_id']; ?>"  
	                admin_trigger="click" ><?php echo $_obj['description']; ?></div>
					<?php } else { ?>
					<?php echo $_obj['description']; ?>
					<?php } ?>
				</td>
				<td valign="top">
					<div admin_type="<?php if (!$_obj['type']) echo 'text'; else echo $_obj['type']; ?>"
                	admin_para="m=update&table=config&column=value&id=<?php echo $_obj['config_id']; ?>"  
                    admin_trigger="click" ><?php echo $_obj['value']; ?></div>
				</td>
				<?php if ($_stack[0]['debug']){ ?>
				<td valign="top">
					<?php if (check_show('delete')):?>
					<a href="javascript:;" onclick="if (confirm(' 确定要删除这条设置吗？')) delete_config(<?php echo $_obj['config_id']; ?>,this)"> 删除</a>
					<?php endif;?>
				</td>
				<?php } ?>
			</tr>
			<?php } $_obj=$_stack[--$_stack_cnt];} ?>
		</table>

                <br />
                <br />


        </div>
        
    </div>
</div>

<script>

function new_config()
{
	$('#new_config').fadeTo(10,0).slideDown(200).fadeTo('fast',1);
}
function cancel_new_config()
{
	$('#new_config').fadeTo('fast',0).slideUp(200);
}
function delete_config(id,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=delete&table=config&id='+id,{ },delete_callback);
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