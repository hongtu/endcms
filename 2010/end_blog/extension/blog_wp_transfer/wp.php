<?php

$blog = model('blog',END_ROOT.'end_blog/model/blog/');
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
		$posts = $GLOBALS['db']->get_all("SELECT * FROM `wp_posts` WHERE `ID` IN (SELECT `object_id` as `ID` FROM `wp_term_relationships` WHERE `term_taxonomy_id` = '$tid') AND post_type='post' AND post_status='publish' LIMIT 1");
		foreach($posts as $p)
		{
			$data = array();
			$data['name'] = $p['post_title'];
			$data['content'] = $p['post_content'];
			$data['status'] = 1;
			$data['category_id'] = $category_id;
			$data['create_time'] = strtotime($p['post_date_gmt']);
			$new_id = $blog->add($data);
			echo $new_id.'<br />';
		}
	}
?>
<?php
}
?>