<?php

$blog = model('blog');
$category = model('category');

$id = intval($_GET['id']);
$cid = intval($_GET['cid']);

$_obj['navigations'] = get_cats('navigation');

?>