//脚本开始
//创建 login_div dom
if ($('#login_div').length <= 0)
{
	var login = document.createElement('div');
	jQuery(login)
		.addClass('login_div')
		.attr('id','login_div')
		.css('display','none');
	jQuery(document.body).append(login);
}


function load_login_window()
{
	
	//var height = $('#topdiv').height();
	//var left = parseInt((window.screen.availWidth - $('#login_div').width())/2);
	//var top = parseInt((height - $('#login_div').height())/2);
	$('#login_div')
		//.css('left',left+'px')
		//.css('top',top+'px')
		.center()
		.html('Loading...')
		.fadeIn('slow')
		.load("login.php?module=ajax").center();
}

function close_login_window()
{
	$('#login_div').fadeOut('slow');
}

function run_login()
{
	var name = $('#login_input_username').val();
	var pass = $('#login_input_password').val();
	$.post('login.php?module=ajax&m=login',{'name':name,'password':pass},login_callback,'json');
}

function login_callback(data)
{
	if (data.msg) 
		alert(data.msg);
	if (data.eval)
		try{ eval(data.eval); } catch(e) { }
	if (data.success)
	{
		window.location.reload();
		load_admin();
		$('[id^=footer_]').css('display','none');
		$('#footer_logout').fadeIn();
	}
}

load_login_window();
//脚本结束