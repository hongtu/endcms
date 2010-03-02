<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $_obj['config']['site_name']; ?>  管理登陆</title>
<style>
body
{
	margin:0;
	padding:0;
	background-color:#BCCD6F; 
	overflow:hidden;
	font-size:12px;
	height:100%;
	color:#fff;
}
#upper
{
	background:#7bbed8 url(end_system/view/admin/images/login_bg_top.jpg) repeat-x 100% 0;
	height:50%;
	margin:0;
	padding:0;
}
table.full
{
	width:100%;
	height:100%;
}
h1.title
{
	display:block;
	width:80%;
	float:right;
	margin:0;
	margin-bottom:20px;
}
.form
{
	width:80%;
	text-align:right;
	margin-top:20px;
}
.copyright
{
	width:80%;
	text-align:right;
	margin-top:50px;
}
#err_msg
{
	color:red;
}
a:link,
a:visited
{
	text-decoration: none;
	color: #ffffff;
}
a:hover {
	text-decoration: underline;
	color: #2582A4;
}
input{
	height:18px;
	background:none; 
	border:none;
	color: #ffffff;
	font-size: 12px;
	border-bottom: solid 1px; 
}
.button{
	height:23px;
	background:none; 
	border: #ffffff solid 1px;
	color: #ffffff;
	font-size: 12px;
	padding-top:3px;
	padding-bottom:2px;
	padding-left:2px;
}
</style>
<script>
setTimeout(function()
{
	document.getElementById('err_msg').style.display='none';
},10000);
</script>
</head>
<body>
	<div id="upper">
		<table class="full" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td valign="bottom">
					<h1 class="title"><?php echo $_obj['config']['site_name']; ?>  管理登陆</h1>
				</td>
			</tr>
		</table>
	</div>
	<form name="myform" method="post" action="admin.php?p=login&module=admin&m=login&backurl=<?php
echo urlencode($_obj['backurl']);
?>" >
		<div class="form">
			<span id="err_msg"><?php echo $_obj['err_msg']; ?>&nbsp;&nbsp;&nbsp;</span>
			 用户名:
			<input name="name" id="username" type="text" size="15" value="" /> 
			 密码:
			<input name="password" type="password" size="15" value="" />
			<input type="submit" name="dosubmit" value=" 登录" class="button" /> 
		</div>
	</form>
 	<div class="copyright">
		Copyright &copy; <a href="http://www.endcms.com" target="_blank">Longbill</a>
	</div>
	<script>
	document.getElementById('username').focus();
	</script>
</body>
</html>