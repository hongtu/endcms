<?php
//lll 2010-2-2

END_MODULE != 'admin' && die('Access Denied');

filter_array($_GET,'status',true);
$obj_person_preview = new PersonPreview;
$cond=array();

//order added by longbill
if ($_GET['order'] && $_GET['asc'])
	$cond['order'] = $_GET['order'].' asc';
else if ($_GET['order'])
	$cond['order'] = $_GET['order'].' desc';
else
	$cond['order']='created_at DESC';

if(isset($_GET['status']) && $status != 'all') $cond['status'] = intval($status);
$person_previews = end_page($obj_person_preview,$cond,20);
$view_data['person_previews'] = $person_previews;
$view_data['status'] = isset($status)?$status:'all';
