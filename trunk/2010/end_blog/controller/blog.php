<?php

if (preg_match('/^\d{4}$/',$_GET['argv'][0]) && preg_match('/^\d{2}$/',$_GET['argv'][1]))
{
	Header( "HTTP/1.1 301 Moved Permanently" ); 
	$url = $config['site_url'].str_replace('//','/','blog/'.$_GET['argv'][2].'/');
	Header( "Location: ".$url);
	die;
}

$name = $_GET['argv'][0];
if (!$name) die('404');
$blog = model('blog')->get($name);
if (!$blog) die('404');

model('blog')->add_view($blog['blog_id']);
$view_data['comments'] = model('comment')->get_list(array('blog_id'=>$blog['blog_id'],'status'=>1,'order'=>'comment_id ASC'));
$view_data['title'] = $blog['name'];
$view_data['blog'] = $blog;

//发送 blog_id 的md5值 作为发布评论时候的验证
header('Set-Cookie: PHPSESSSID='.md5($blog['blog_id']).'; expires=Fri, 14-May-2015 20:00:21 GMT; path=/');

