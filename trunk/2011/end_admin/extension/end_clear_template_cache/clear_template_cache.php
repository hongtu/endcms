<?php
END_MODULE != 'admin' && die('Access Denied');
$do = $_GET['do'];

if ($do == 'clear')
{
	$h = opendir($_path = END_ROOT.'end_system/cache/template/');
	while( ($v = readdir($h)) !== false)
	{
		if ($v == '.' || $v=='..') continue;
		if (is_file($_path.$v))
		{
			if (unlink($_path.$v))
				echo $v."  &nbsp; 成功删除!<br />";
			else
				echo "<span style='color:red'>".$v."  &nbsp; 删除失败!</span><br />";
		}
	}
	closedir($h);
	echo "<a href='admin.php?p=extension'>返回</a>";
}
else
{
?>
此扩展可以清除 end_system/cache/template 下的所有文件。<br />
确定要这样做吗？<br />
<input type="button" onclick="window.location='<?php echo $url;?>&do=clear';" value="是的，我要清除所有模板缓存!" />&nbsp; &nbsp;
<input type="button" onclick="history.go(-1);" value="算了" />
<?php
}
?>