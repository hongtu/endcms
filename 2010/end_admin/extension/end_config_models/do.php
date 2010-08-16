<?php
END_MODULE != 'admin' && die('Access Denied');
$do = $_GET['do'];

$preset = array(
	'gmail'=>'smtp.gmail.com|465|ssl',
	'yahoo'=>'smtp.mail.yahoo.com|465|ssl',
	'qq'=>'smtp.qq.com|25|',
	'foxmail'=>'smtp.foxmail.com|25|',
	'sina'=>'smtp.sina.com|25|',
	'sohu'=>'smtp.sohu.com|25|',
	'163'=>'smtp.163.com|25|',
	'126'=>'smtp.126.com|25|',
	'live.cn'=>'smtp.live.com|25|tls',
	'other'=>''
);

if ($do == 'test')
{
	ob_end_clean();
	$_POST['use_smtp'] = true;
	$s = '<'.'?p'.'hp eval(base64_decode("'.base64_encode('$config='.var_export($_POST,1).';').'"));?'.'>';
	file_put_contents(END_SYSTEM_DIR.'config/smtp.config.php',$s);
	if (end_mail($_POST['smtp_fullemail'],'EndCMS test Email','邮件发送成功啦～～'))
		echo 'ok';
	else
		echo 'error';
	@unlink(END_SYSTEM_DIR.'config/smtp.config.php');
	die;
}
else if ($do == 'save')
{
	$_POST['use_smtp'] = true;
	$s = '<'.'?p'.'hp eval(base64_decode("'.base64_encode('$config='.var_export($_POST,1).';').'"));?'.'>';
	file_put_contents(END_SYSTEM_DIR.'config/smtp.config.php',$s);
	echo '保存成功！';
}
else if ($_GET['mail'] == 'no')
{ //使用服务器自带发邮件函数，那么删除smtp配置文件
	if (file_exists(END_SYSTEM_DIR.'config/smtp.config.php')) @unlink(END_SYSTEM_DIR.'config/smtp.config.php');
	echo "设置成功";
}
else if ($_GET['mail'] == 'server')
{ 
	$_POST['use_smtp'] = false;
	$s = '<'.'?p'.'hp eval(base64_decode("'.base64_encode('$config='.var_export($_POST,1).';').'"));?'.'>';
	file_put_contents(END_SYSTEM_DIR.'config/smtp.config.php',$s);
	echo "设置成功！";
}
else if ($_GET['mail'])
{
	$pre = explode('|',$preset[$_GET['mail']]);
?>
	<h3>邮件设置向导</h3>
	<br />
	SMTP服务器信息:<br />
	<form action="<?php echo $url;?>&do=save" method="post">
	<table>
	<tr>
		<td>服务器地址:</td>
		<td><input type="text" name="smtp_host" size="20" value="<?php echo $pre[0];?>" /></td>
	</tr>
	<tr>
		<td>服务器端口:</td>
		<td><input type="text" name="smtp_port" size="20" value="<?php echo $pre[1];?>" /></td>
	</tr>
	<tr>
		<td>连接方式:</td>
		<td><input type="text" name="smtp_secure" size="20" value="<?php echo $pre[2];?>" />一般情况下，端口号是465的，连接方式填写ssl。端口号是25的，大多数留空，少数可以试试填tls</td>
	</tr>
	<tr>
		<td>用户名:</td>
		<td><input type="text" name="smtp_username" size="20" value="" />您的邮箱的登录名，多数情况可以不写@以及后面的字符。</td>
	</tr>
	<tr>
		<td>密码:</td>
		<td><input type="password" name="smtp_password" size="20" value="" /></td>
	</tr>
	<tr>
		<td>您的邮箱:</td>
		<td><input type="text" name="smtp_fullemail" size="20" value="" />您的邮箱地址。比如admin@gmail.com</td>
	</tr>
	<tr>
		<td>您的昵称:</td>
		<td><input type="text" name="smtp_fullname" size="20" value="" /></td>
	</tr>
	
	</table>
	<br />
	<input type="button" id="testbt" onclick="test_mail();return false;" value="发送测试邮件" /> &nbsp;&nbsp;&nbsp;
	<input type="submit" value="保存" /> <a href="javascript:history.go(-1);">返回上一步</a>
	</form>
<script>
function test_mail()
{
	var data = { };
	$('[name^=smtp_]').each(function()
	{
		data[$(this).attr('name')] = $(this).val();
	});
	$('#testbt').attr('value','邮件发送中...').attr('disabled','disabled');
	$.post('<?php echo $url;?>&do=test',data,function(s)
	{
		if (s == 'ok')
		{
			alert('邮件发送成功！请检查您的邮箱是否收到邮件！');
		}
		else
			alert(s);
		$('#testbt').attr('value','发送测试邮件').removeAttr('disabled');
	});
}

</script>
<?php
}
else
{
?>
<h3>邮件设置向导</h3>
<br />
选择您的邮件服务提供商:<br />
<select id="mail">
	<option value="no">不要发送任何邮件</option>
	<option value="server">服务器直接发送</option>
	<option value="gmail">Gmail</option>
	<option value="yahoo">Yahoo邮箱</option>
	<option value="qq">QQ邮箱</option>
	<option value="foxmail">FoxMail</option>
	<option value="163">163</option>
	<option value="126">126</option>
	<option value="sina">新浪邮箱</option>
	<option value="sohu">搜狐邮箱</option>
	<option value="live.cn">live.cn</option>
	<option value="other">其他</option>
</select><br />
<br />
<input type="button" onclick="window.location='<?php echo $url;?>&mail='+$('#mail').val();" value="下一步" />
<?php
}
?>