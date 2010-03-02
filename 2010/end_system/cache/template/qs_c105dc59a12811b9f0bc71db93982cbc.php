<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Refresh" content="<?php echo $_obj['time']; ?>;url=<?php echo $_obj['url']; ?>">
<title> 系统消息</title>

<script>
setTimeout("go_url('<?php echo $_obj['url']; ?>')",<?php echo $_obj['time']; ?>*1000+2000);
function go_url(url)
{
	window.location = "<?php echo $_obj['url']; ?>";
}
</script>



<style>
body,td,table
{
	font-size:14px;
	color:#333333;
}
.box_title
{
	font-family: Tahoma, Verdana;
	color: #FFFFFF; 
	font-weight: bold; 
	background:#B0DFFD url(end_system/view/admin/images/topbar_bg.jpg) repeat-y top left;
}

a,a:visited,a:hover,a:active
{
	text-decoration:none;
	color:#333333;
	font-size:12px;
}
.box_content
{
	background-color:#fff;
	font-family: Tahoma, Verdana; 
	color: #0c8fee;
}
</style>
</head>

<body >

<table cellspacing="0" cellpadding="0" border="0" align="center" height="80%" width="50%">
     <tr>
     	<td>
			<table border="0" cellspacing="1" cellpadding="5" bgcolor="#0c87e1" align="center">
               	<tr>
               		<td class="box_title"> 系统消息</td>
               	</tr>
   				<tr>
                	<td class="box_content"><div style="margin:10px;font-weight:bold;"><?php echo $_obj['content']; ?></div>
                    <div class='footer'><a href="<?php echo $_obj['url']; ?>"> 如果没有自动跳转，请点击这里</a></div>
                    </td>
                </tr>
  			</table>
 		</td>
     </tr>
</table>

</body>
</html>



