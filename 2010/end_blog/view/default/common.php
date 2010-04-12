<?php

$blog = model('blog');
$category = model('category');

$id = intval($_GET['id']);
$cid = intval($_GET['cid']);

$_obj['navigations'] = $category->get_cats_by_alias('navigation');

?>