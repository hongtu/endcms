
function reply(someone)
{
	var content = $('#new_comment_value_content');
	content.val( '@'+someone+' '+content.val()).focus();
}

$(function()
{
	$('#new_comment_value_email').add('#new_comment_value_name').blur(function()
	{
		if ($(this).val() == '') 
			$(this).addClass('empty');
		else
			$(this).removeClass('empty');
	});
	$('#new_comment_value_url').blur(function()
	{
		var val = $(this).val();
		if (!val) return;
		if (!val.match(/^http/i)) val = 'http://'+val;
		$(this).val(val);
	});
	
	$('#new_comment_value_email').val($.cookie('blog_email'));
	$('#new_comment_value_name').val($.cookie('blog_name'));
	$('#new_comment_value_url').val($.cookie('blog_url'));
});

function submit_comment()
{
	var data = { };
	data.blog_id = window.blog_id;
	$('[id^=new_comment_value]').each(function()
	{
		var k = $(this).attr('id').replace('new_comment_value_','');
		data[k] = $(this).val();
	});
	if (data.name == '')
	{
		$('#new_comment_value_name').addClass('empty').focus();
		return;
	}
	if (data.email == '' || !data.email.match(/\@/))
	{
		$('#new_comment_value_email').addClass('empty').focus();
		return;
	}
	if (data.content == '')
	{
		$('#new_comment_value_content').focus();
		return;
	}
	$.cookie('blog_name',data.name,{ path:'/' });
	$.cookie('blog_email',data.email, { path:'/'});
	$.cookie('blog_url',data.url,{ path:'/'});
	$('#new_comment_submit').attr('value','提交中...').attr('disabled','disabled');
	$('[id^=new_comment_value]').attr('disabled','disabled');
	$.post('index.php?p=addcomment&t='+Math.random(),data,function(s)
	{
		$('[id^=new_comment_value]').removeAttr('disabled');
		$('#new_comment_submit').attr('value','提交').removeAttr('disabled');
		if (s.match(/^comment\d+$/i))
		{
			window.location = window.location.href.toString().replace(/\?.*$/,'') + '?t='+ Math.floor(Math.random()*10000)+'#'+s;
		}
		else
		{
			alert("发生错误:\n" + s.substr(0,500));
		}
	});
}