<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>评论管理 -  后台</title>
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
	                <li><a href="admin.php?p=comment">评论管理</a></li>
	            </ul>
	    		
	        </div>
	    </div>
	    <div id='maindiv'>
			<div class="description">
				评论管理
	        </div>
	        <div class="real_content">
	        	<?php if (!$_obj['itemid']){ ?>
				<div class="nav_wrapper">
					&nbsp;类别:
					<a href="admin.php?p=comment&itemtype=all&status=<?php echo $_obj['status']; ?>" class="nav <?php if ($_obj['itemtype'] == "all"){ ?>nav_on<?php } ?>">全部</a>
					<a href="admin.php?p=comment&itemtype=program&status=<?php echo $_obj['status']; ?>" class="nav <?php if ($_obj['itemtype'] == "program"){ ?>nav_on<?php } ?>">直播提问</a>
					<a href="admin.php?p=comment&itemtype=video&status=<?php echo $_obj['status']; ?>" class="nav <?php if ($_obj['itemtype'] == "video"){ ?>nav_on<?php } ?>">点播评论</a>
					
				</div>
				<?php } ?>
				
				<?php if ($_obj['itemid']){ ?>
				<div class="nav_wrapper">
					&nbsp;当前您查询的节目是:《<?php echo $_obj['itemname']; ?>》
				</div>
				<?php } ?>
				<div class="nav_wrapper">
					&nbsp;状态:
					<a href="admin.php?p=comment&itemtype=<?php echo $_obj['itemtype']; ?>&status=all&itemid=<?php echo $_obj['itemid']; ?>" class="nav <?php if ($_obj['status'] == "all"){ ?>nav_on<?php } ?>" >全部</a>
					<?php if (!empty($_obj['statuses'])){if (!is_array($_obj['statuses']))$_obj['statuses']=array(array('statuses'=>$_obj['statuses'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['statuses'] as $rowcnt=>$statuses) { $statuses['ROWCNT']=($rowcounter); $statuses['ALTROW']=$rowcounter%2; $statuses['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$statuses; ?>
					<a href="admin.php?p=comment&itemtype=<?php echo $_stack[$_stack_cnt-1]['itemtype']; ?>&status=<?php echo $_obj['id']; ?>&itemid=<?php echo $_stack[$_stack_cnt-1]['itemid']; ?>" class="nav <?php if ($_stack[$_stack_cnt-1]['status'] == $_obj['id']&& $_stack[$_stack_cnt-1]['status'] != "all"){ ?>nav_on<?php } ?>"><?php echo $_obj['name']; ?></a>	
					<?php } $_obj=$_stack[--$_stack_cnt];} ?>
				</div>
				
				----------------------------------------<br />
				<div style="text-align:center"><?php echo $_obj['pager']; ?></div>
	            
<table cellpadding="0" cellspacing="1" border="0" class="align_center list_table" id="admin_table">
            	<thead>
                   	<tr>
                		<th width="150" order="username">用户名</th>
                        <th width="150" order="created_at">时间</th>
                   		<th order="content">内容</th>
                   		<th order="status">状态</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                
          		  	<?php if (!empty($_obj['comments'])){if (!is_array($_obj['comments']))$_obj['comments']=array(array('comments'=>$_obj['comments'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['comments'] as $rowcnt=>$comments) { $comments['ROWCNT']=($rowcounter); $comments['ALTROW']=$rowcounter%2; $comments['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$comments; ?>
            		<tr>
               		 	<td><?php echo $_obj['username']; ?></td>
                        <td><?php echo preg_replace("/(^20)|(\:\d\d$)/","",$_obj['created_at']);?></td>
               		    <td><?php echo $_obj['content']; ?></td>
                        <td style="width:50px"><?php
echo show_status($_obj['status']);
?></td>
                        <td>
                        <?php if ($_obj['status'] != "1"){ ?>
                        <a href="javascript:;" onclick="delete_user(<?php echo $_obj['comment_id']; ?>,1,this)">通过</a> 
                        <?php } ?>
                        <?php if ($_obj['status'] != "2"){ ?>
                        <a href="javascript:;" onclick="delete_user(<?php echo $_obj['comment_id']; ?>,2,this)">删除</a>
                        <?php } ?>
                        </td>
                       
               		</tr>
                    <?php } $_obj=$_stack[--$_stack_cnt];} ?>
                    
                </tbody>
                
</table>

<script type="text/javascript">

function delete_user(id,value,o)
{
	$(o).attr('to_be_delete','yes').html(' ...').unbind('click');
	$.post('admin.php?p=ajax&m=update&column=status&table=comment&id='+id,{ value:value },delete_callback);
}

function delete_callback(s)
{
	if(parseInt(s)>0)
		$('[to_be_delete=yes]').parent().parent().fadeOut();
		else
			alert(s);
}
</script>
				<div style="text-align:center"><?php echo $_obj['pager']; ?></div>
				
	        </div>
	        
	    </div>
	</div>
	
	
	
	
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