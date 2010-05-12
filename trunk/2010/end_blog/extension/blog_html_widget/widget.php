<?php
END_MODULE != 'admin' && die('Access Denied');
global $end_module,$end_extension;
$do = $_GET['do'];
$hook_id = intval($_GET['hook_id']);
if ($hook_id > 0)
{
	$hook = model('hook')->get_one($hook_id);
	$settings = eval('return '.$hook['settings'].';');
}
else
{
	$settings = array();
}



if ($do == 'save')
{
	$data = array('title'=>$_POST['title'],'content'=>$_POST['content']);
	$settings = var_export($data,true);
	$hook_to = $_POST['hook_to'];
	list($hook_to_m,$hook_to) = explode(':',$hook_to,2);
	$func_file = str_replace(END_ROOT,'',getcwd()).'/function.php';
	if ($hook_id)
	{
		model('hook')->delete($hook_id);
	}
	
	if (end_add_hook($hook_to_m,$hook_to,$func_file,'show_blog_widget',$settings,'blog_html_widget',$_POST['title']))
	{
		echo $hook_id?"修改成功<br>":"添加成功！<br>";
		echo "<a href='admin.php?p=extension'>返回</a>";
	}
	else
	{
		echo $hook_id?'修改失败<br>':'添加失败！<br>';
		echo '<a href="javascript:history.go(-1);">返回</a>';
	}
}
else
{


?>
<style>
table td { padding:3px; }
</style>
<form action="<?php echo $url;?>&do=save&hook_id=<?php echo $hook_id;?>" method="post">
<table border="0" >
	<tr>
		<td width="80">显示区域:</td>
		<td><select name="hook_to">
<?php
foreach($end_module as $mname=>$m)
if ($m['hooks'])
foreach($m['hooks'] as $k=>$v)
{
?>
	<option value="<?php echo $mname.':'.$k;?>" 
	<?php
	if ($mname == $hook['module'] && $k == $hook['hook']) echo 'selected="selected"';
	?>
 	><?php echo $m['name'].':'.$v;?></option>
<?php	
}?>
</select></td>
	</tr>
	<tr>
		<td>标题:</td>
		<td><input type="text" name="title" size="30" value="<?php echo $settings['title'];?>"/></td>
	</tr>
	<tr>
		<td>内容:<br />
		可以输入php代码和html代码
		</td>
		<td>
			<textarea name="content" rows="15" cols="80"><?php echo htmlspecialchars($settings['content']);?></textarea>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" value="提交" />
			<input type="button" value="返回" onclick="history.go(-1)" />
		</td>
	</tr>
</table>
</form>


<?php
}
?>