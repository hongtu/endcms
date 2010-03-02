<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>拍卖管理 -  后台</title>
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
        	<h2>拍卖分类</h2>
			<div id="category_tree">
				<ul>
					<?php if (!empty($_obj['cates'])){if (!is_array($_obj['cates']))$_obj['cates']=array(array('cates'=>$_obj['cates'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['cates'] as $rowcnt=>$cates) { $cates['ROWCNT']=($rowcounter); $cates['ALTROW']=$rowcounter%2; $cates['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$cates; ?>
					<li><a href="admin.php?p=auction&category_id=<?php echo $_obj['category_id']; ?>"><?php echo $_obj['name']; ?></a></li>
					<?php } $_obj=$_stack[--$_stack_cnt];} ?>
				</ul>
			</div>
        </div>
    </div>
    <div id='maindiv'>
    	<div class="description">
			<a href="admin.php?p=auction">拍卖管理</a>
			<?php if ($_obj['current_category']){ ?>
			&nbsp;&gt;&nbsp;
			<?php echo $_obj['current_category']; ?>
			<?php } ?>
			<?php if ($_obj['current_item']){ ?>
			&nbsp;&gt;&nbsp;
			<?php echo $_obj['current_item']; ?>
			<?php } ?>
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
        <?php if ($_obj['current_item']){ ?>
        	<?php echo $_obj['page_content']; ?>
		<br />
        <?php } else { ?>
        <table cellpadding="0" cellspacing="0" border="0" class="align_center list_table" width="100%">
        	<thead>
        		<tr>
        			<th order="auction_id">编号</th>
        			<th order="title">标题</th>
        			<th order="start_date">开始日期</th>
        			<th order="end_date">结束日期</th>
        			<th order="base_price">起价</th>
        			<th order="guaranty_price">保证金</th>
        			<th order="step_price">加价</th>
        			<th order="current_price">现价</th>
        			<th order="winner_num">中标人数</th>
        			<th order="bidder_num">竞价人数</th>
        			<th order="status">状态</th>
        			
        		</tr>
        	</thead>        
        <?php if (!empty($_obj['items'])){if (!is_array($_obj['items']))$_obj['items']=array(array('items'=>$_obj['items'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['items'] as $rowcnt=>$items) { $items['ROWCNT']=($rowcounter); $items['ALTROW']=$rowcounter%2; $items['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$items; ?>
        	<tr>
        		<td><?php echo $_obj['auction_id']; ?></td>
        			<td><a href="admin.php?p=auction&category_id=<?php echo $_obj['category_id']; ?>&item_id=<?php echo $_obj['auction_id']; ?>"><?php echo $_obj['title']; ?></a></td>
        			<td><?php echo date("Y-m-d H:i:s",$_obj['start_date']);?></td>
        			<td><?php echo date("Y-m-d H:i:s",$_obj['end_date']);?></td>
        			<td><?php echo $_obj['base_price']; ?></td>
        			<td><?php echo $_obj['guaranty_price']; ?></td>
        			<td><?php echo $_obj['step_price']; ?></td>
        			<td><?php echo $_obj['current_price']; ?></td>
        			<td><?php echo $_obj['winner_num']; ?></td>
        			<td><?php echo $_obj['bidder_num']; ?></td>
        			<td><?php
echo show_status($_obj['status']);
?></td>
				
			</tr>
		<?php } $_obj=$_stack[--$_stack_cnt];} ?>
		</table>
		<?php echo $_obj['pager']; ?>
        <?php } ?>
	<br />
        </div>
        <br />
    </div>
	<div style="clear:both;"></div>
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
<script type="text/javascript">
function invalidBid(bidId, status, obj) {
	if(confirm('确认' + $(obj).html()+ "?")) {

		$.post('admin.php?p=auction',{ act: 'invalid_bid', id: bidId, status: status },null);
		
		$(obj).parent().prev().html(status ==1 ? '无效' : '有效');
		$(obj).remove();
	}
}

function invalidUser(auctionId, userId, obj) {
	if(confirm('确认' + $(obj).html()+ "?")) {

		$.post('admin.php?p=auction',{ act: 'invalid_user', auction_id: auctionId, user_id: userId },null);

		$(obj).parent().html('已经设置为无效');
		
	}
}
</script>
</body>
</html>