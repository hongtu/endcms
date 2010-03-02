<?php
END_MODULE != 'admin' && die('Access Denied');
$page = new Page;
filter_array($_GET,'intval:pageid,intval:add,intval:edit,intval:delete,id,intval:draft,intval:fabu,intval:check',true);
filter_array($_POST,'pagename,title,content',true);

if(isset($pagename) && $pagename != '' && $check ==1){
	$r = $page->exists(array('page_name'=>$pagename));
	echo $r?1:0;
	die;
}

function fabu($pageid){
	global $page;
	$objp=$page->getPage($pageid);
	$ft = fopen(END_TOPPATH.'files/__template__.php','r');
	$str = fread($ft,filesize(END_TOPPATH.'files/__template__.php'));
	$str = str_replace("[PAGE_TITLE]",$objp['title'],$str);
	$content = str_replace('"','\"',$objp['content']);
	$str = str_replace("[PAGE_CONTENT]",$content,$str);
	fclose($ft); 
	$ft = fopen(END_TOPPATH.'files/'.$objp['page_name'],'w');
	fwrite($ft,$str);
	fclose($ft); 
	return 1;
}

function save(){
	global $page,$title,$pagename,$content,$pageid;
	//echo $pageid;
	if($pageid == 0){
		//检查权限
		check_allowed('page','add'); 
		$id = $page->add(array('title'=>$title,'page_name'=>$pagename,'content'=>$content,'admin_name'=>$_SESSION['login_user']['name']));
	}else{
		check_allowed('page','update');
		$id = $page->update($pageid,array('title'=>$title,'page_name'=>$pagename,'content'=>$content,'admin_name'=>$_SESSION['login_user']['name']));
	}
	
	return $id;
}

if(isset($title) && $title != '' && isset($content) && $content != '' && $draft != 1)
{
	$id = save();
	//echo $id;exit;
	if($id){
		fabu($id);
		end_exit('发布成功','admin.php?p=page',1);
	}else{
		end_exit('发布失败','admin.php?p=page',1);
		}
}

if($fabu == 1){
	
	$r = fabu($pageid);
	
}

if($draft == 1){
	$id = save();
	if($id){
		end_exit('草稿保存成功','admin.php?p=page',1);
	}else{
		end_exit('草稿保存失败','admin.php?p=page',1);
		}	
}

if($delete && $id){
	$deletepage = $page->getPage($id);
	unlink(END_TOPPATH.'files/'.$deletepage['page_name']);
	$page->delete($id);
}
$cond=array();


if ($_GET['order'] && $_GET['asc'])
	$cond['order'] = $_GET['order'].' asc';
else if ($_GET['order'])
	$cond['order'] = $_GET['order'].' desc';


$pages = end_page($page,$cond,20);
if($add == 1){
	$view_data['add'] = $add;
}
if($edit == 1 && $pageid != 0){
	$view_data['edit'] = $edit;
	$editPage = $page->getPage($pageid);
	$view_data['editpage'] = $editPage;
	
}
$view_data['pages'] = $pages;
