<?php

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



function php_String($str) 
{ 
/*
@  作者:Andyfoo,andyfoo.net
@
*/
    return "<ol style='color: #003366; line-height: 16px'>".eregi_replace("<br /></font>|<br></font>|<br />|<br>","</font><li>",highlight_string (stripslashes($str),true))."</ol>"; 
}