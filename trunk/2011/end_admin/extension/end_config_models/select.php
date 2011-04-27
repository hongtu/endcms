<?php
END_MODULE != 'admin' && die('Access Denied');


if (!isset($_GET['step']))
{
?>
<form action="<?php echo $url;?>&step=1" method="post">
选择模块：<select name="module">
<?php
$h = opendir(END_ROOT);
while(($v = readdir($h)) !== false)
{
	if ($v == '.' || $v == '..' || !is_dir(END_ROOT.$v)) continue;
	if (preg_match('/^end_([a-z0-9\_]+)$/i',$v,$ms))
	{
		if ($ms[1] == 'system') continue;
		echo "<option value='$ms[0]'>$ms[0]</option>";
	}
}
closedir($h);
?>
</select><br />
<input type="submit" value="下一步" />
</form>
<?php
}

else if ($_GET['step'] == 1 && $_POST['module'] && preg_match('/^end_([a-z0-9\_]+)$/i',$_POST['module']))
{
?>
	<form action="<?php echo $url;?>&step=2" method="post">
	<input type="hidden" name="module" value="<?php echo $_POST['module'];?>" />
	选择模块"<?php echo $_POST['module'];?>"下的数据模型：<select name="model">
	<option value=".new">添加新的数据模型</option>
	<?php
	$h = opendir($root = END_ROOT.$_POST['module'].'/model/');
	while(($v = readdir($h)) !== false)
	{
		if ($v == '.' || $v == '..' || !is_dir($root.$v)) continue;
		if (preg_match('/^[a-z0-9\_]+$/',$v))
			echo "<option value='$v'>$v</option>";
	}
	closedir($h);
	?>
	</select><br />
	<input type="submit" value="下一步" />
	</form>
<?php	
}

//添加新的
else if ($_GET['step'] == 2 && $_POST['module'] && $_POST['model'] == '.new')
{
	
}

?>