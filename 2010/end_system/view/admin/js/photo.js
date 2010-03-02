



function get_checked()
{
	checked_photo_ids = '';
	$('[admin=check]').each(function()
	{
		if (this.checked) checked_photo_ids += this.id.replace('img_check_','') + ',';
	});
	return checked_photo_ids.substr(0, checked_photo_ids.length - 1);
}

function check_all()
{
	$('[id^=img_check_]').attr('checked','true');
	show_border();
}
function inverse()
{
	$('[id^=img_check_]').each(function()
	{
		this.checked = !this.checked;
	});
	show_border();
}
function show_border()
{
	$('[admin=check]').each(function()
	{
		var img_id = this.id.replace('_check_','_img_');
		if (this.checked)
			$('#'+img_id).addClass('checked_img').fadeTo(1,0.7);
		else
			$('#'+img_id).removeClass('checked_img').fadeTo(1,1);
	});
}


function close_preview()
{
	$('[preview]').fadeOut('fast',function()
	{
		$('[preview]').each(function()
		{
			this.parentNode.removeChild(this);
		});
	});
}

function get_page_size()
{
	var div = document.createElement('div');
	$(div).css(
	{
		position:'absolute',
		top:0,left:0,
		margin:0,border:0,padding:0,
		width:'100%',height:'100%',
		zIndex:99,
		backgroundColor:'transparent'
	}).html(' ');
	$(document.body).append(div);
	var re = {};
	re.height = ($(document.body).height() > $(div).height())?$(document.body).height():$(div).height();
	re.width = ($(document.body).width() > $(div).width())?$(document.body).width():$(div).width();
	document.body.removeChild(div);
	return re;
}

function preview(url)
{
	var bg = document.createElement('div');
	var page = get_page_size();
	$(bg).css(
		{
			height: page.height,
			width: page.width,
			zIndex: '999',
			display:'none',
			position:'absolute',
			top:'0px',
			left:'0px',
			padding:'0px',
			margin:'0px'
		})
		.fadeTo(1,0,function(){ this.style.display = ''; })
		.attr('id','preview_bg')
		.attr('preview','yes')
		.bind('click',close_preview);
		
	
	$(document.body).append(bg);
	$(bg).css('background-color','#000000').fadeTo(700,0.91);
	
	var div = document.createElement('div');
	$(div)
		.css(
		{
			height: '100px',
			width: '100px',
			zIndex: '1000',
			backgroundColor: '#fff',
			position:'absolute',
			top:'0px',
			left:'0px',
			padding:'0px',
			margin:'0px'
		})
		.attr('preview','yes');
	
	
	
	$(div)
		.attr('id','preview_img_div')
		.attr('img_src',url)
		.css(
			{ 
				top: $(document).scrollTop()+50, 
				left: $(document).scrollLeft() + ($(window).width() / 2) -50
			})
		.fadeIn()
		.bind('click',function(event){ event.returnValue = false; return false; });
	$(document.body).append(div);

	window.preview_worked = false;
	var imgobj = new Image();
	$(imgobj).bind('load',preview_img_load).attr('id','preview_hidden_img').attr('src',url).css('display','none').attr('preview','yes');
	$(document.body).append(imgobj);
	if (imgobj.width>0 && imgobj.height>0 ) preview_img_load.call(imgobj);

}


function preview_img_load()
{
	if (window.preview_worked) return;
	window.preview_worked = true;
	var div_width = parseInt(this.width) + 20;
	var div_height = parseInt(this.height) + 20;

	$('#preview_img_div')
		.animate({ width: div_width , left: $(document).scrollLeft() + ($(window).width() - div_width ) / 2 },700)
		.animate({ height: div_height }, 700 ,function()
		{ 
			var img = document.createElement('img');
			img.style.margin = "10px";
			img.src = $('#preview_img_div').attr('img_src');
			
			$(img).fadeTo(1,0,function()
			{
				$('#preview_img_div').append(this).find('img').fadeTo('fast',1, function()
				{
					var div = document.createElement('div');
					$(div)
						.css('height','30px')
						.html('<div style="float:right;margin-right:10px;cursor:pointer;width:50px;font-weight:bold;" onclick="close_preview()">CLOSE</div>');
					$('#preview_img_div').append(div).animate({ height:'+=30px'},'fast');
				});
			});
		});
}



$(function()
{
	$('[admin=img]').bind('click',function(event)
	{
		var chk_id = this.id.replace('_img_','_check_');
		$('#'+chk_id).each( function()
		{ 
			this.checked = !this.checked;  
			var img_id = this.id.replace('_check_','_img_');
			if (this.checked)
			{
				$('#'+img_id).addClass('checked_img').fadeTo('fast',0.7);
			}
			else
				$('#'+img_id).removeClass('checked_img').fadeTo('fast',1);
		} );
		
	});
	show_border();
});
