//初始化
function init_admin()
{
	//定义 单行文本可编辑对象的鼠标事件
	$("[admin_type^=text]")
		.bind('mouseover',text_mouseover)
		.bind('mouseout',text_mouseout)
		.each(function()
		{
			if ($(this).html().match(/^\s*$/)) $(this).html('&nbsp;');
		});
	
	
	$("[admin_type=button_item_list]")
		.addClass('admin_button')
		.html("{NEW_ITEM_BUTTON}");
		
	window.edit_input = false;
}

//卸载admin
function unadmin()
{
	$("[admin_type=text]").unbind();
	$('[admin]').html('');
	$("[admin_type=button_item_list]").html('');
}

//文本类型可编辑对象 当鼠标移上时
function text_mouseover(event,o)
{
	if (window.edit_input) return;
	var o = o?o:this;
	$(o)
		.addClass('text_mouseover')
		.attr('current_edit','yes')
		.bind('click',text_edit)
		.bind('dblclick',text_edit);
	$(o).find('a').click(function(){ return false; });
}


//当编辑按钮消失完后，取消所有 current_edit 标记
function remove_current_edit()
{
	$('[current_edit=yes]').removeAttr('current_edit');
}

//文本类型可编辑对象 当鼠标移出时
function text_mouseout(event,o)
{
	if (window.edit_input) return;
	var o = o?o:this;
	$(o).removeClass('text_mouseover');
}

//文本类型可编辑对象 当点击取消按钮时
function text_cancel_click(event,o)
{
	window.edit_input = false;
	var o = o?o:this;
	if (window.text_save_timer) clearTimeout(window.text_save_timer);
	var current_edit = $('[editing=yes]');
	current_edit
		.css('display','none')
		.html(current_edit.attr('old_value'))
		.fadeIn('fast')
		.unbind()
		.bind('mouseover',text_mouseover)
		.bind('mouseout',text_mouseout);
	$('[edit_input=yes]').each(function()
	{
		this.parentNode.removeChild(this);
	});
}

//文本类型可编辑对象 改成可编辑状态
function text_edit(o)
{
	debug = 0;
	if (debug) alert('into text_edit()');
	if ($('[edit_input=yes]').length) return;
	if (window.text_save_timer) clearTimeout(window.text_save_timer);

	$('[editing=yes]').removeAttr('editing');
	$('[edit_input=yes]').removeAttr('edit_input');
	window.edit_input = false;
	$('[saving=yes]').removeAttr('saving');
	if ($(this).attr('admin_select_value')) //如果是select类型
	{
		select_edit.call(this);
		return;
	}
	if (debug) alert('2');
	var val = $(this).html();
	$(this)
		.trigger('mouseout')
		.attr('old_value',val)
		.attr('editing','yes')
		.unbind();
		//.css('display','none');
	if (debug) alert('3');
	if ($(this).attr('admin_type') == 'textarea')
	{
		var input = document.createElement('textarea');
		val = val.replace(/<br\s*\/?>/ig,"\n");
		var self = this;
		var height_handler = function()
		{
			$(this).height($(self).height()).height(this.scrollHeight);
		}
		$(input).bind('keydown',height_handler).bind('keyup',height_handler)
	}
	else
	{
		var input = document.createElement('input');
	}
	if (debug) alert('4');
	input.value = (val == '&nbsp;')?'':val;
	//附加dom对象
	var left = parseInt(this.offsetLeft);
	var o = this;
	while(o.offsetParent) 
	{
		o = o.offsetParent;
		left += parseInt(o.offsetLeft);
	}
	var top = parseInt(this.offsetTop);
	var o = this;
	while(o.offsetParent) 
	{
		o = o.offsetParent;
		top += parseInt(o.offsetTop);
	}
	if (debug) alert('5');
	$(input).css(
	{
		position:'absolute',
		left:(+left-1)+'px',
		height:$(this).height(),
		width:$(this).width(),
		padding:0,
		margin:0,
		top:(+top-1)+'px',
		textAlign:$(this).css('text-align'),
		lineHeight:$(this).css('line-height')?$(this).css('line-height'):$(this).height(),
		fontSize:$(this).css('font-size')
	});//.css('z-index',10);
	if (debug) alert('5.5');
	document.body.appendChild(input);
	if (debug) alert('6');
	window.edit_input = true;
	$(input)
		.focus()
		.addClass('text_input')
		.attr('edit_input','yes')
		.bind('blur',function()
		{
			window.text_save_timer = setTimeout("text_save()",$('[editing=yes]').attr('admin_button') != 'no' ?500:100); //失去焦点后自动保存
		}).bind('keydown',function(event)
		{
			if (event.keyCode == 27)
			{
				text_cancel_click(event,this);
			}
		});
	if (debug) alert('7');	
	if ($(this).attr('admin_type') != 'textarea')
	{
		$(input).bind('keypress',function(event)
		{
			if (event.keyCode == 13)
				window.text_save_timer = setTimeout("text_save()",10);
		});
	}
}

//select 编辑
function select_edit(o)
{
	window.edit_input = true;
	var val = $(this).attr('admin_select_value');
	var source = $_($(this).attr('admin_select_source_id'));
	$(this)
		.trigger('mouseout')
		.attr('old_value',val)
		.attr('editing','yes')
		.unbind();
	var input = document.createElement('select');

	
	var left = parseInt(this.offsetLeft);
	var o = this;
	while(o.offsetParent) 
	{
		o = o.offsetParent;
		left += parseInt(o.offsetLeft);
	}
	var top = parseInt(this.offsetTop);
	var o = this;
	while(o.offsetParent) 
	{
		o = o.offsetParent;
		top += parseInt(o.offsetTop);
	}
	
	$(input).css(
	{
		position:'absolute',
		left:(+left-1)+'px',
		height:$(this).height(),
		width:$(this).width(),
		padding:0,
		margin:0,
		top:(+top-1)+'px',
		//zIndex:parseInt(parseInt(this.style.zIndex)+1),
		textAlign:$(this).css('text-align'),
		lineHeight:$(this).css('line-height')?$(this).css('line-height'):$(this).height(),
		fontSize:$(this).css('font-size')
	});
	document.body.appendChild(input);

	for(i=0;i<source.options.length;i++)
	{
		input.appendChild(source.options[i].cloneNode(1));
	}

	for(i=0;i<input.options.length;i++)
	{
		var o = input.options[i];
		o.selected = (o.value == val);
	}
	
	$(input)
		.addClass('text_input')
		.attr('edit_input','yes')
		.focus()
		.bind('blur',function()
		{
			window.text_save_timer = setTimeout("text_save()",100); //失去焦点后自动保存
		})
		.bind('change',function(event)
		{
			window.text_save_timer = setTimeout("text_save()",100);
		});
	$(document.body).bind('keydown',function(event)
	{
		if (event.keyCode == 27)
			text_cancel_click(event,this);
	});
}

function text_save()
{
	if (!window.edit_input) return;
	var val = $('[edit_input=yes]').val();
	var p = $('[editing=yes]');
	var para = p.attr('admin_para');
	p.html('saving..')
		.attr('saving','yes')
		.fadeIn('fast');
	$('#admin_option_div').css('display','none');
	$('[edit_input=yes]')
		.removeAttr('edit_input')
		.css('display','none');
	$('[edit_input=yes]').removeAttr('edit_input');
	$('[editing=yes]').removeAttr('editing');
	
	if (p.attr('admin_select_value'))
	{
		p.attr('admin_select_value',val);
	}
	
	if (p.attr('admin_type') == 'textarea')
	{
		val = val.replace(/\n/ig,'<br>');
	}
	
	if (para.toLowerCase().indexOf('.php?') == -1)
		var post_url = 'admin.php?p=ajax&'+para;
	else
		var post_url = para;
	if (p.attr('old_value') != val)
		$.post(post_url,{'value':val},text_ajax_callback);
	else
		text_ajax_callback(val);
}

function text_ajax_callback(s)
{
	var o = $('[saving=yes]');
	$('[edit_input=yes]').add('.text_input').each(function()
	{
		this.parentNode.removeChild(this);
	});
	if (o.attr('admin_select_value'))
	{
		var source = $_(o.attr('admin_select_source_id'));
		for(i=0;i<source.childNodes.length;i++)
		{
			if ($(source.childNodes[i]).val() == s)
			{
				s = $(source.childNodes[i]).html();
			}
		}
	}
	window.edit_input = false;
	o.html(s)
		.removeAttr('saving')
		.removeClass('text_mouseover');
	init_admin(); //重新初始化
}





//退出登录
function run_logout()
{
	$.post('login.php?module=ajax&m=logout',{},logout_callback,'json');
}

function logout_callback(data)
{
	if (data.msg) 
		alert(data.msg);
	if (data.eval)
		try{ eval(data.eval); } catch(e) {  }
	if (data.success)
	{
		unadmin();
		$('[id^=footer_]').css('display','none');
		$('#footer_login').fadeIn();
	}
}


init_admin();