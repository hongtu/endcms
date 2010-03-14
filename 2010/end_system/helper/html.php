<?php

/*
get fragment content from item table by name
*/
function fragment($name)
{
	global $loader;
	$obj = model('category');
	$obj = $obj->get_one( array('alias'=>$name) );
	return $obj['content'];
}

/*
find a image url from a text
*/
function get_first_image_url($s,$min_width = 150,$min_height = 80)
{
	preg_match_all('/<img[^>]*src=[\'\"]([^\'\"]{1,})[\'\"]/i',$s,$ms);
	foreach($ms[1] as $img)
	{
		//$info = getimagesize($img);
		//if ($info && $info[0] >= $min_width && $info[1] >= $min_height) return $img;
		if (preg_match('/\.(jpg|jpeg)$/i',$img)) return $img;
	}
	return false;
}

function show_description_text($s,$len)
{
	$s = strip_tags($s);
	$s = preg_replace('/&nbsp;/',' ',$s);
	$s = preg_replace('/\s{2,}/','',$s);
	$_s = cn_substr($s,0,$len);
	return ($s == $_s)?$s:$_s.'...';
}

function html_pager($url,$total_page,$page = 1)
{
	$page_span = 4;
	$pager = '';
	if ($page>1)
		$pager .= ' <a href="'.$url.'&page=1">'.LANG_PAGER_FIRST.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_FIRST.'</a> ';
	if ($page>1)
		$pager.= ' <a href="'.$url.'&page='.($page-1).'">'.LANG_PAGER_PREV.'</a> ';
	else
		$pager.= ' <a href="javascript:;" class="grey">'.LANG_PAGER_PREV.'</a> ';
	
	if ($page>$page_span)
		$pager.= '...';
	
	for($i=$page-$page_span+1;$i<$page+$page_span;$i++)
	{
		if ($i<=0 || $i>$total_page) continue;
		if ($page == $i)
			$pager.= " [{$i}] ";
		else
			$pager.= ' <a href="'.$url.'&page='.$i.'">'.$i.'</a> ';
	}
	
	if ($total_page-$page>$page_span)
		$pager.= '...';
	
	
	if ($page<$total_page)
		$pager.= ' <a href="'.$url.'&page='.($page+1).'">'.LANG_PAGER_NEXT.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_NEXT.'</a> ';
	if ($page<$total_page)
		$pager .= ' <a href="'.$url.'&page='.$total_page.'">'.LANG_PAGER_LAST.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_LAST.'</a> ';
	return $pager;
}
/*
get page indexes html
*/
function index_html_pager($url,$total_page,$page = 1)
{
	$page_span = 4;
	$pager = '';
	if ($page>1)
		$pager .= ' <a href="'.$url.'index.html" class="black_11">'.LANG_PAGER_FIRST.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_FIRST.'</a> ';
	if ($page>1)
		$pager.= ' <a href="'.$url.($page-1).'.html" class="black_11">'.LANG_PAGER_PREV.'</a> ';
	else
		$pager.= ' <a href="javascript:;" class="grey">'.LANG_PAGER_PREV.'</a> ';
	
	if ($page>$page_span)
		$pager.= '...';
	
	for($i=$page-$page_span+1;$i<$page+$page_span;$i++)
	{
		if ($i<=0 || $i>$total_page) continue;
		$_urlname = $i==1?'index':$i;
		if ($page == $i)
			$pager.= " [{$i}] ";
		else
			$pager.= ' <a href="'.$url.$_urlname.'.html" class="black_11">'.$i.'</a> ';
	}
	
	if ($total_page-$page>$page_span)
		$pager.= '...';
	
	
	if ($page<$total_page)
		$pager.= ' <a href="'.$url.($page+1).'.html" class="black_11">'.LANG_PAGER_NEXT.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_NEXT.'</a> ';
	if ($page<$total_page)
		$pager .= ' <a href="'.$url.$total_page.'.html" class="black_11">'.LANG_PAGER_LAST.'</a> ';
	else
		$pager .= ' <a href="javascript:;" class="grey">'.LANG_PAGER_LAST.'</a> ';
	return $pager;
}


function end_page($obj,$cond = array(),$per_page)
{
	global $view_data;

	$cond['select'] = 'count(1)';
	$total = $obj->get_list( $cond );
	$total = $total[0]['count(1)'];
	$page = isset($_GET['page'])?intval($_GET['page']):0;
	$per_page <= 0 && $per_page = 20;
	!$page && $page=1;
	$total_page = ceil($total/$per_page);
	!$total_page && $total_page=1;
	$page>$total_page && $page = $total_page;
	$cond['select'] = '*';
	$cond['from'] = ($page-1)*$per_page;
	$cond['total'] = $per_page;
	$pager = LANG_PAGER_TOTAL.$total.LANG_PAGER_ITEMS.$total_page.LANG_PAGER_PAGE.'<br />';
	$url = $_SERVER['REQUEST_URI'];
	$url = preg_replace('/\??&?page=[0-9]{1,}/','',$url);
	$pager.=html_pager($url,$total_page,$page);
	$view_data['pager'] = $pager;
	$view_data['older_entries'] = ($page == $total_page)?'':"<a href='{$url}?page=".($page+1)."'>".LANG_OLDER_ENTRIES."</a>";
	$view_data['newer_entries'] = ($page == 1)?'':"<a href='{$url}?page=".($page-1)."'>".LANG_NEWER_ENTRIES."</a>";
	return $obj->get_list( $cond );
}

function end_index_page($obj,$cond = array(),$per_page,$url='',&$info=array())
{
	global $view_data;
	$info = array();
	$cond['select'] = 'count(*)';
	$total = $obj->get_list( $cond );
	$total = $total[0]['count(*)'];
	$page = intval($_GET['page']);
	$per_page <= 0 && $per_page = 20;
	!$page && $page=1;
	$total_page = ceil($total/$per_page);
	$info['total_page'] = $total_page;
	!$total_page && $total_page=1;
	$page>$total_page && $page = $total_page;
	$cond['select'] = '*';
	$cond['from'] = ($page-1)*$per_page;
	$cond['total'] = $per_page;
	//$pager = LANG_PAGER_TOTAL.$total.LANG_PAGER_ITEMS.$total_page.LANG_PAGER_PAGE.'<br />';
	if (!$url)
	{
		$url = $_SERVER['REQUEST_URI'];
		$url = preg_replace('/&?page=[0-9]{1,}/','',$url);
		$pager.= html_pager($url,$total_page,$page);
	}
	else $pager.=index_html_pager($url,$total_page,$page);
	$view_data['pager'] = $pager;
	return $obj->get_list( $cond );
}

/*
make empty folder only
*/
function end_mkdir($path)
{
	$arr = explode('/',$path);
	for($i=0;$i<=count($arr);$i++)
	{
		$p.= $arr[$i].'/';
		if (!is_dir($p)) mkdir($p);
	}
	return $p;
}


/*
check url name
*/
function ck_url_name($s)
{
	if (!preg_match('/^[0-9a-zA-Z_]{1,}$/',$s)) return false;
	return $s;
}


/*
get blog item url path
*/
function get_item_path($data)
{
	if (!is_array($data) && @intval($data) > 0)	$data = array('item_id'=>$data);
	if (!$data['url_name'] && $data['item_id'])
	{
		include_once('model/item.php');
		$item = new END_Item;
		$_arr = $item->get_one($data['item_id']);
		$data['url_name'] = $_arr['url_name'];
		$data['publish_time'] = $_arr['publish_time'];
	}
	if ($data['url_name'] && $data['publish_time'])
	{
		return date('Y',$data['publish_time'])
			.'/'.date('m',$data['publish_time']).'/'.$data['url_name'].'/';
	}
	else return '';
}

/*
mv item folder
*/
function end_mv($p1,$p2)
{
	$p1 = END_TOPPATH.$p1;
	$p2 = END_TOPPATH.end_mkdir($p2);
	rename($p1,$p2);
}

/*
delete item folder
*/
function end_delete($path)
{
	unlink(END_TOPPATH.$path.'/index.html');
	unlink(END_TOPPATH.$path.'/index.php');
	return rmdir(END_TOPPATH.$path);
}

/*
update 
*/
function end_update($p = '')
{
	$f = END_TOPPATH.$p.'index.html';
	if (file_exists($f)) 
		return unlink($f);
	//else
	//	die('update error! '.$f);
}

/*
send download header and output filedata
*/
function download_file($filepath, $filename = '')
{
	if(!$filename) $filename = basename($filepath);
	if(is_ie()) $filename = rawurlencode($filename);
	$filetype = strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
	$filesize = sprintf("%u", filesize($filepath));
	if(@ob_get_length() !== false) @ob_end_clean();
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');
	header('Content-Transfer-Encoding: binary');
	header('Content-Encoding: none');
	header('Content-type: '.$filetype);
	header('Content-Disposition: attachment; filename="'.$filename.'"');
	header('Content-length: '.$filesize);
	readfile($filepath);
	exit;
}

/*
replace <br /> or <br> with \n
*/
function clean_br($s,$to = ' ')
{
	return preg_replace('/<br\s*\/?>/i',$to,$s);
}

function print_space($length = 1)
{
	$re = '';
	for($i=0;$i<$length;$i++) $re.='&nbsp;&nbsp;';
	return $re;
}

function print_category_tree($arr,$category_id=0,$excluded=array(),$depth=0)
{
	$re = '';
	if (!is_array($arr)) return;
	if (!is_array($excluded)) $excluded = array($excluded);
	if ($depth > 100) return;
	foreach($arr as $c)
	{
		if ($c['category_id'] && in_array($c['category_id'],$excluded)) continue;
		if ($c['status'] == 'folder')
		{
			$re.="<optgroup label='".print_space($depth).$c['name']."'>";
			$re.=print_category_tree($c['children'],$category_id,$excluded,$depth+1);
			$re.="</optgroup>";
		}
		else
		{
			$re.= "<option value='".$c['category_id']."' ";
			if ($category_id && $c['category_id'] == $category_id) $re.= " selected='selected' ";
			$re.=">".print_space($depth).$c['name']."</option>\n";
			$re.=print_category_tree($c['children'],$category_id,$excluded,$depth+1);
		}
	}
	return $re;
}

function print_category_tree_link($url,$arr,$category_id=0,$depth=0)
{
	$re = '<ul>';
	if (!is_array($arr) || count($arr) == 0) return '';
	foreach($arr as $c)
	{
		$re.= "<li><a title='".$c['description']."' href='$url".$c['category_id']."' class='status_".$c['status'];
		if ($category_id && $c['category_id'] == $category_id) $re.= " tree_on";
		$re .="'>".$c['name']."</a></li>\n";
		$_re = print_category_tree_link($url,$c['children'],$category_id,$depth+1);
		$_re && $re .= '<li style="display:none">'.$_re.'</li>';
	}
	$re.='</ul>';
	return $re;
}

function en_substr($s,$end)
{
	if (strlen($s)<= $end) return $s;
	if (substr($str,$end,1) !=' ')
	{
		for($i=1;$i<20;$i++)
		{
			if (substr($s,$end+$i,1) == ' ') break;
		}
		$end+=$i;
	}
	return substr($s,0,$end).'...';
}

function category_link($obj)
{
	return $obj['url'];
}

function item_link($obj)
{
	return $obj['url'];
}
