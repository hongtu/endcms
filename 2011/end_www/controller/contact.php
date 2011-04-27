<?php

$data = filter_array($_POST,'htmlspecialchars:name,htmlspecialchars:phone,htmlspecialchars:email,htmlspecialchars:content!');
if ($data)
{
	model('contact')->add($data);
	die('ok');
}
die('error!');
