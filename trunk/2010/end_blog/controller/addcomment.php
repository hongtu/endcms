<?php
//验证提交的合法性
//
if (strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) === false) die('error1');
$data = filter_array($_POST,'name!,email!,content!,url,intval:blog_id!');
if ($data)
{
	if ($data['name'] != $_COOKIE['blog_name'] || $data['email'] != $_COOKIE['blog_email'])
	{
		die('error3');
	}
	if (md5($data['blog_id']) != $_COOKIE['PHPSESSSID'])
	{
		die('error4');
	}
	if (!preg_match('/^[a-z0-9\.\-\_]+\@[a-z0-9\.\-\_]+\.[a-z0-9\.\-\_]+$/',$data['email'])) die("邮件格式错误！");
	if ($data['url'] && !preg_match('/^http\:\/\/[a-z0-9\.\-]+\.[a-z]{2,10}/',$data['url'])) die("网址格式错误！");
	preg_match_all('/(http|www)/i',$data['content'],$ms);
	if (count($ms[1]) > 2) die("您的评论内容含有太多链接！");
	
	//转义
	foreach($data as $k=>$v) $data[$k] = htmlspecialchars($v);
	
	$data['time'] = time();
	$data['status'] = 1;
	
	$blog = model('blog')->get_one($data['blog_id']);
	
	$commentid = model('comment')->add($data);
	if ($commentid > 0)
	{
		//更新文章的评论数
		$arr = model('comment')->get_one(array('select'=>'count(1) as total','blog_id'=>$data['blog_id'],'status'=>1));
		if ($arr)
			model('blog')->update($data['blog_id'],array('comment_count'=>$arr['total']));


		//发邮件给自己
		$url = $config['site_url'].'blog/'.$blog['url'].'/#comment'.$commentid;
		$data['comment_id'] = $commentid;
		$tmp = template('mail_me.html');
		$tmp->assign('blog',$blog);
		$tmp->assign('comment',$data);
		$tmp->assign('url',$url);
		$content = $tmp->result();
		end_mail($config['admin_email'],'新评论:'.$blog['name'],$content);
		
		//发邮件给别人
		preg_match_all('/\@([^\s]+)\s/',$data['content'],$ms);
		foreach($ms[1] as $name)
		{
			$people = model('comment')->get_one(array('name'=>$name,'blog_id'=>$data['blog_id'],'order'=>'time DESC'));
			if ($people && $people['email'] && $people['email'] != $config['admin_email']) //不要再发给自己
			{
				$tmp = template('mail_other.html');
				$tmp->assign('blog',$blog);
				$tmp->assign('old',$people);
				$tmp->assign('comment',$data);
				$tmp->assign('url',$url);
				$content = $tmp->result();
				end_mail($people['email'],$data['name'].' 在 '.$blog['name'].' 上回复了您的评论 - '.$config['site_name'],$content);
			}
		}
		
		die('comment'.$commentid);
	}
	else
		die('error5');
}
else die('error2');
die('error x');
?>