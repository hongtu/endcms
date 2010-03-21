<?php

$blog = model('blog');
$tmp = template('blog.html',END_MODEL_DIR.'blog/');
$tmp->assign('items',$blog->get_list());
$tmp->output();
die;
?>