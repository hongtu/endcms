<?php
END_MODULE != 'admin' && die('Access Denied');
echo file_get_contents('http://update.endcms.net/?v='.END_VERSION);
?>