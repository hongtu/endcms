<?php

/*
end_mail( to email address, subject,body[,reply to email address, reply to name ])
*/
function end_mail($to,$subject,$body,$replyto='',$replyto_name='')
{
	global $config;
	include_once(END_SYSTEM_DIR.'plugin/phpmailer/class.phpmailer.php');
	try {
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
		$body = preg_replace('/\\\\/','', $body); //Strip backslashes
		if ($config['mail_method'] == 'smtp') $mail->IsSMTP();            
		$mail->SMTPDebug = false;
		$mail->CharSet = 'utf-8';
		if ($config['smtp_auth']) $mail->SMTPAuth   = true; 
		if ($config['smtp_port']) $mail->Port       = $config['smtp_port']; 
		if ($config['smtp_secure']) $mail->SMTPSecure = $config['smtp_secure'];
		if ($config['smtp_host']) $mail->Host = $config['smtp_host'];
		if ($config['smtp_username']) $mail->Username  = $config['smtp_username'];
		if ($config['smtp_password']) $mail->Password  = $config['smtp_password'];
		$mail->From = $config['mail_from'];
		$mail->FromName = $config['mail_fromname'];
		!$replyto && $replyto = $config['mail_from'];
		$mail->AddReplyTo($replyto,$replyto_name);
		$mail->AddAddress($to);
		$mail->Subject  = $subject;
		$mail->WordWrap   = 80; // set word wrap
		$mail->MsgHTML($body);
		$mail->IsHTML(true); // send as HTML
		$mail->Send();
		return true;
	} catch (phpmailerException $e) {
		echo $e->errorMessage();
		return false;
	}
}

function check_show($action)
{
	$controller = defined('ITEM_TYPE')?ITEM_TYPE:END_CONTROLLER;
	return $_SESSION['login_user']['rights'][$controller.'_'.$action];
}


/*
get client ip address
*/
function ip()
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{
		$ip = getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';
}


/*
check if the action is allowed
*/
function check_allowed($controller,$action,$text = false)
{
	if (END_MODULE != 'admin') return true;
	if (!$action) 
		$action = $controller;
	else
		$action = $controller.'_'.$action;
	if (!$_SESSION['login_user']['rights'][$action])
	{
		if ($text)
		{
			echo LANG_NOT_ALLOWED;
			die;
		}
		else
			end_exit(LANG_NOT_ALLOWED);
	}
	else return true;
}



function check_allowed_category($category_id,$text = false)
{
	if (END_MODULE != 'admin') return true;
	if ($_SESSION['login_user']['limit_category_id'] && !$_SESSION['login_user']['rights']['categroy_'.$category_id])
	{
		if ($text)
		{
			echo LANG_NOT_ALLOWED;
			die;
		}
		else
			end_exit(LANG_NOT_ALLOWED);
	}
	else return true;
}

/*
output a msg box for $t seconds then redirect to $url
*/
function end_exit($content,$url='javascript:history.go(-1);',$t = 2)
{
	$temp = template('exit.html');
	$temp->assign( array
	(
		'content' => $content,
		'url' => $url,
		'time' => $t,
	));
	$temp->output();
	die;
}


/*
get a substring of UTF-8 words
*/
function cn_substr($str, $start, $len,$dotted='')
{
	$tmpstr = "";
	$strlen = strlen($str);
	$cnt = 0;
	$istr = '';
	for($i = 0; $i < $strlen; $i++) 
	{
        if(ord(substr($str, $i, 1)) > 127) 
		{
            $istr = substr($str, $i, 3);
            $i+=2;
        }
		else
		{
            $istr = substr($str, $i, 1);
		}
		if ( $cnt >= $start && $cnt < $start+$len)
		{
			$tmpstr .= $istr;
		}
		$cnt++;
    }
    return ($str == $tmpstr)?$tmpstr:$tmpstr.$dotted;
}



/*
get a simple formated date string
*/
function format_date($t)
{
	if (strpos($t,'-') !== false) return $t;
	return date('Y-m-d H:i',$t);
}

function show_day($t)
{
	if (strpos($t,'-') !== false) return $t;
	return date('m-d',$t);
}

/*
get a short type date string 
e.g.	today 21:23 (when it's the same day)
		yesterday 21:23 (when it's yesterday)
*/
function format_date_short($t)
{
	if (date('Y',$t) != date('Y'))
	{
		$re = date('Y'.LANG_YEAR.'m'.LANG_MONTH.'d'.LANG_DAY,$t);
	}
	else if (date('m',$t) != date('m'))
	{
		$re = date('m'.LANG_MONTH.'d'.LANG_DAY,$t);
	}
	else if (date('d',$t) != date('d'))
	{
		switch( date('d',$t) - date('d') )
		{
			case 2:
				$re = LANG_TDAT;
				break;
			case 1:
				$re = LANG_TOMORROW;
				break;
			case -1:
				$re = LANG_YESTERDAY;
				break;
			default:
				$re = date('d'.LANG_DAY,$t);
		}
	}
	else
	{
		$re = LANG_TODAY;
	}
	$re .= date('H:i',$t);
	return $re;
}

/*
get a approximately past time
e.g. 3seconds  5hours  7days 
*/
function format_past_time($t)
{
	$d = time()-$t;
	if ($d < 60)
	{
		return $d.LANG_SECONDS;
	}
	$d = intval($d/60);
	if ($d < 60)
	{
		return $d.LANG_MINUTES;
	}
	$d = intval($d/60);
	if ($d < 24)
	{
		return $d.LANG_HOURS;
	}
	$d = intval($d/24);
	if ($d < 30)
	{
		return $d.LANG_DAYS;
	}
	$d = intval($d/30);
	if ($d < 12)
	{
		return $d.LANG_MONTHS;
	}
	return intval($d/12).LANG_YEARS;
}


/*
check if certain action is allowed or not
*/
function if_allowed($action)
{
	if ($_SESSION['login_user']['name'] == 'Administrator' || $_SESSION['login_user']['rights'] == 'all')
	{
		return true;
	}
	else
	{
		return (strpos(','.$_SESSION['login_user']['rights'].',',','.$action.',') !== false);
	}
}
/*
get user name with user_id
*/
function get_user_name($id)
{
	global $end_users;
	if (!is_array($end_users))
	{
		include_once('model/user.php');
		$user = new END_User;
		$end_users = $user->get_array();
	}
	return $end_users[$id];
}


/*
separate description and whole content
*/
function end_separate($s,$url)
{
	global $config;
	if (strpos($s,$config['end_separator']) === false) return $s;
	$arr = explode($config['end_separator'],$s);
	return $arr[0].'...<a href="'.$url.'" class="readmore">'.$config['end_readmore'].'</a>';
}

function getext($filename)
{
	$filename = trim(strtolower(basename($filename)));
	$arr = explode('.',$filename);
	$type = $arr[count($arr)-1];
	return $type;
}

function myurlencode($url)
{
	return str_replace( array('+','%2F'),array('%20','/'),urlencode($url));
}


function thumb($orig_path,$mw=100,$mh=100,$thumb=false,$method='fill')
{
	if (!$orig_path) return 'about:blank';
	$path = END_ROOT.$orig_path;
	$ftype = array_pop(explode('.',$path));
	$etag = $mw.'x'.$mh.'_'.basename($path);

	if (!file_exists($path)) return '';
	
	if ($thumb === false)
		$thumb = dirname($path).'/'.$etag;
	//echo 'thumb file:'.$thumb.'<br />';
	//overwrite ?
	if (file_exists($thumb)) return dirname($orig_path).'/'.$etag;

	if (!$imgarr=@getimagesize($path)) return ''; 
	$width_orig=$imgarr[0];
	$height_orig=$imgarr[1];
	//echo 'orig_width='.$width_orig.'  orig_height='.$height_orig.'<br />';
	$mime_orig=$imgarr["mime"];
	$mime=str_replace("image/","",$mime_orig);
	$mime=($mime=="bmp")?"wbmp":$mime;
	if (!function_exists("imagecreatefrom$mime")) return false;

		$p = $mw/$width_orig;
		$_p = $mh/$height_orig;
		if ($_p>$p)
		{
			$p = $_p;
			$width = $p*$width_orig;
			$height = $p*$height_orig;
			$cut_height = 0;
			$cut_width = intval(($width_orig - $mw/$p)/2);
		}
		else
		{
			$width = $p*$width_orig;
			$height = $p*$height_orig;
			$cut_height = intval(($height_orig - $mh/$p)/2);;
			$cut_width = 0;
		}
		$width = $mw;
		$height = $mh;
	
	$image_p = @imagecreatetruecolor($width, $height);
	$_func = 'imagecreatefrom'.$mime;
	$image = @$_func($path);
	@imagecopyresampled($image_p, $image, 0, 0, $cut_width, $cut_height, $width, $height, $mw/$p, $mh/$p);
	$_func = 'image'.$mime;
	@$_func($image_p,$thumb,90);
	return (file_exists($thumb))?dirname($orig_path).'/'.$etag:false;
}



/*
if the client browser is IE
*/
function is_ie()
{
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
	if(strpos($useragent, 'msie ') !== false) return true;
	return false;
}


function load_models()
{
	global $end_models,$end_rights;
	$_h = opendir(END_ROOT);
	while($v = readdir($_h))
	{
		if (is_dir(END_ROOT.$v) 
		&& preg_match('/^end_/',$v) 
		&& is_dir($mdir = END_ROOT.$v.'/model/') 
		&& $__h = opendir($mdir) )
		{
			while($v = readdir($__h))
			{
				if (is_dir($mdir.$v) && file_exists($mfile = $mdir.$v.'/'.$v.'.config.php'))
				{
					include_once($mfile);
					$end_models[$v]['model_path'] = $mdir.$v.'/';
				}
			}
			closedir($__h);
		}
	}
	closedir($_h);
	$_models = array();
	foreach($end_models as $key=>$arr)
	{
		if ($arr['type'] == 'list') $key.= '_list';
		$_models[$key] = $arr;
	}
	$end_models = $_models;
}

function end_show_edit_button($id)
{
	echo ' <a href="admin.php?p=item&action=edit_item&category_id='.END_ADMIN_CATEGORY_ID.'&item_id='.$id.'">'.LANG_EDIT.'</a> ';
}
function end_show_delete_button($id)
{
	echo ' <a href="admin.php?p=item&action=edit_item&category_id='.END_ADMIN_CATEGORY_ID.'&item_id='.$id.'">'.LANG_DELETE.'</a> ';
}

