<?php
END_MODULE != 'admin' && die('Access Denied');
$do = $_GET['do'];

if ($do == 'run')
{
	if ($_POST['sql'])
	{
		if (@mysql_query($_POST['sql']))
		{
			echo "您的SQL语句已经成功运行!<br /><br>";
		}
		else
		{
			echo "<span style='color:red'>出错:</span><br>";
			echo mysql_error();
			echo "<br><br>";
		}
	}
	else
	{
		echo '<span style="color:red">您没有输入任何SQL语句</span><br>';
	}
	echo "<a href='javascript:history.go(-1);'>继续输入SQL语句</a>  &nbsp; ";
	echo "<a href='admin.php?p=extension'>退出此扩展</a>  &nbsp; ";
}
else if ($do == 'show_input')
{
?>
<form action="<?php echo $url;?>&do=run" method="post">
请输入您要执行的SQL语句:<br />
<textarea name="sql" rows="10" cols="100"></textarea><br />
<input type="submit" value="提交" />
</form>
<?php
}
else
{
?>
<span style="color:red">安全提醒：</span><br />
此扩展可以运行任意SQL语句。在执行SQL语句之前，您应该明白该语句产生的后果，否则可能让您的网站的数据丢失。后果非常严重。<br />
您确定要继续吗？<br />
<input type="button" onclick="window.location='<?php echo $url;?>&do=show_input';" value="我已经明白此操作的后果。我要运行SQL语句!" />&nbsp; &nbsp;
<input type="button" onclick="history.go(-1);" value="算了" />
<?php
}
?>