<?php

$blog = model('blog',END_ROOT.'end_blog/model/blog/');
$comment = model('comment',END_ROOT.'end_blog/model/comment/');
$link = model('link',END_ROOT.'end_blog/model/link/');
$blog_item_category_id = 5; //博客文章所在分类ID


if (!$_POST['do'])
{
?>
第一步：<br />
<form action="<?php echo $url;?>" method="post">
<!-- select name="database">
<?php
$r = $GLOBALS['db']->get_all("show databases");
foreach($r as $t)
{
	$d = $t['Database'];
	echo "<option value='$d'>$d</option>";
}
?>
</select><br / -->
<input type="hidden" name="do" value="yes" />
是否清空现有的博客分类和文章: <input type="checkbox" name="clear" /><br />
<input type="submit" value="下一步" />
</form>
<?php
}
else
{
	//mysql_select_db($_POST['database']);
	if ($_POST['clear'] == 'on')
	{
		$blog->truncate();
		$comment->truncate();
		$link->truncate();
		$sql = "DELETE FROM ".model('category')->table." WHERE parent_id=$blog_item_category_id";
		$GLOBALS['db']->query($sql);
	}
	//获得分类
	$cats = $GLOBALS['db']->get_all("SELECT * 	FROM  `wp_term_taxonomy` WHERE `taxonomy`='category'");
	foreach($cats as $c)
	{
		//获取分类信息
		$term = $GLOBALS['db']->get_one("SELECT * FROM `wp_terms` WHERE term_id='".$c['term_id']."'");
		$cdata = array();
		$cdata['name'] = $term['name'];
		$cdata['parent_id'] = 5; //博客文章分类
		$cdata['status'] = 'blog_list';
		$cdata['url'] = $term['slug'];
		$tid = $c['term_taxonomy_id'];
		//添加分类
		$category_id = model('category')->add($cdata);
		//获取此分类的文章
		$posts = $GLOBALS['db']->get_all("SELECT * FROM `wp_posts` WHERE `ID` IN (SELECT `object_id` as `ID` FROM `wp_term_relationships` WHERE `term_taxonomy_id` = '$tid') AND post_type='post' AND post_status='publish' ORDER BY `post_date_gmt` ASC");
		foreach($posts as $p)
		{
			$data = array();
			$data['name'] = $p['post_title'];
			$data['content'] = $p['post_content'];
			$data['status'] = 1;
			$data['url'] = $p['post_name'];
			$data['category_id'] = $category_id;
			$data['create_time'] = strtotime($p['post_date_gmt']);
			$data['comment_count'] = $p['comment_count'];
			$data['update_time'] = strtotime($p['post_modified_gmt']);
			
			$new_id = $blog->add($data);
			echo $new_id.':'.$data['name'].'<br />';
			$comments = $GLOBALS['db']->get_all("SELECT * FROM `wp_comments` WHERE comment_post_ID='".$p['ID']."' AND comment_approved=1 ORDER BY comment_ID ASC");
			foreach($comments as $c)
			{
				$data = array();
				$data['blog_id'] = $new_id;
				$data['email'] = $c['comment_author_email'];
				$data['name'] = $c['comment_author'];
				$data['content'] = $c['comment_content'];
				$data['url'] = $c['comment_author_url'];
				$data['time'] = strtotime($c['comment_date_gmt']);
				$data['status'] = 1;
				$comment->add($data);
			}
		}
	}
	$GLOBALS['db']->query("INSERT INTO end_link(category_id,order_id,name,description,url,status,rel) SELECT 18 as category_id,link_rating as order_id,link_name as name,link_description as description,link_url as url,1 as status,link_rel as rel FROM wp_links ORDER BY link_id ASC");
?>
<?php
}
?>