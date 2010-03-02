<div>
	<h2>中标者</h2>
	<table cellpadding="0" cellspacing="0" border="0" class="align_center list_table" width="100%">
		<tr>
			<th>用户</th>
			<th>金额</th>
			<th>叫价时间</th>
		</tr>
		<?php if (!empty($_obj['winners'])){if (!is_array($_obj['winners']))$_obj['winners']=array(array('winners'=>$_obj['winners'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['winners'] as $rowcnt=>$winners) { $winners['ROWCNT']=($rowcounter); $winners['ALTROW']=$rowcounter%2; $winners['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$winners; ?>
		<tr>
			<td><?php echo $_obj['username']; ?></td>
			<td><?php echo $_obj['amount']; ?></td>
			<td><?php echo $_obj['created_at']; ?></td>
		</tr>	
		<?php } $_obj=$_stack[--$_stack_cnt];} ?>	
	</table>
</div>

<div>
	<h2>叫价者</h2>
	<table cellpadding="0" cellspacing="0" border="0" class="align_center list_table" width="100%">
		<tr>
			<th>用户</th>
			<th>金额</th>
			<th>叫价时间</th>
			<th>真实姓名</th>
			<th>email</th>
			<th>电话</th>
			<th>手机</th>
			<th>身份证</th>
			<th>省份</th>
			<th>地址</th>
			<?php if ($_obj['auctionobj']['status'] == "1"){ ?>
			<th>操作</th>
			<?php } ?>
		</tr>
		<?php if (!empty($_obj['bidders'])){if (!is_array($_obj['bidders']))$_obj['bidders']=array(array('bidders'=>$_obj['bidders'])); $_stack[$_stack_cnt++]=$_obj; $rowcounter = 0; foreach ($_obj['bidders'] as $rowcnt=>$bidders) { $bidders['ROWCNT']=($rowcounter); $bidders['ALTROW']=$rowcounter%2; $bidders['ROWBIT']=$rowcounter%2; $rowcounter++;$_obj=&$bidders; ?>
		<tr>
			<td><a href="admin.php?p=auction&category_id=<?php echo $_stack[0]['category_id']; ?>&item_id=<?php echo $_stack[0]['auction_id']; ?>&user_id=<?php echo $_obj['user_id']; ?>"><?php echo $_obj['username']; ?></a></td>
			<td><?php echo $_obj['amount']; ?></td>
			<td><?php echo $_obj['created_at']; ?></td>
			<td><?php echo $_obj['real_name']; ?></td>
			<td><?php echo $_obj['email']; ?></td>
			<td><?php echo $_obj['phone']; ?></td>
			<td><?php echo $_obj['mobile']; ?></td>
			<td><?php echo $_obj['id_card_no']; ?></td>
			<td><?php echo $_obj['province']; ?></td>
			<td><?php echo $_obj['address']; ?></td>
			<?php if ($_stack[0]['auctionobj']['status'] == "1"){ ?>
			<td><a href="javascript:;" onclick="invalidUser(<?php echo $_stack[0]['auction_id']; ?>,<?php echo $_obj['user_id']; ?>,this)">设置为无效</a></td>
			<?php } ?>
		</tr>
		<?php } $_obj=$_stack[--$_stack_cnt];} ?>
	</table>
	<?php echo $_obj['pager']; ?>
</div>