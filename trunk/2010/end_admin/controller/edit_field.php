<?php
/*
传入 $_fields

输出 $data , $errors

*/
if (!is_array($_fields)) $fields = array();
foreach($_fields as $name=>$attr)
{
	if (preg_match('/^__/',$name)) continue;
	
	//文件上传
	if ($attr['type'] == 'file')
	{
		//如果选择了文件
		if ($_FILES[$name] && $_FILES[$name]['tmp_name'])
		{
			$file = $_FILES[$name];
			$ftype = getext($file['name']);
			if (!$ftype 
				|| !preg_match("/\*\.$ftype;/i",$config['upload_file_types']) 
				|| !in_array($ftype,$attr['allowed_exts']))
			{
				$errors[$name] = '文件类型不允许';
			}
			else
			{
				if ($attr['rename'])
				{
					$file_url = date('Y_m_d_H_i_s_').rand(1111,9999).'.'.$ftype;
				}
				else
				{
					$file_url = basename($file['name']);
				}
				
				if (!$file_url) 
				{
					$errors[$name] = '错误';
				}
				if (!$attr['saveto'])
				{
					end_mkdir(END_UPLOAD_DIR);
					$file_url = END_UPLOAD_DIR.$file_url;
				}
				else
				{
					end_mkdir($attr['saveto']);
					$file_url = $attr['saveto'].$file_url;
				}
				
				
				
				if (@move_uploaded_file($file["tmp_name"],END_ROOT.$file_url))
				{
					if ($attr['filter']) $file_url  = $attr['filter']($file_url);
					$data[$name] = $file_url;
					
					if (is_array($attr['resize']))
					{
						foreach($attr['resize'] as $_r)
						{
							if (is_array($_r) && $_r['width'] && $_r['height'])
							{
								$__re = thumb($file_url,$_r['width'],$_r['height']);
							}
						}
					}
				}
				else
				{
					$errors[$name] = '文件上传错误';
				}
			}
		}
		//如果本来就有值，表示没有修改
		else if ($_POST[$name])
		{
			$data[$name] = $_POST[$name];
		}
		else if (!$attr['null'])
		{
			$errors[$name] = '不能为空';
		}
	}
	else if ($attr['type'] == 'datetime')
	{
		$t = $_POST[$name];
		if (is_array($t))
		{
			$data[$name] = mktime($t['h'],$t['i'],$t['s'],$t['m'],$t['d'],$t['y']);
		}
		else
			$data[$name] = 0;
	}
	//其他类型数据
	else
	{
		$data[$name] = $_POST[$name];
		if ($attr['filter']) $data[$name] = $attr['filter']($data[$name]);
		if ($attr['type'] == 'checkbox') $data[$name] = $data[$name]?'1':'0';
		if ($attr['type'] == 'textarea')
		{
			$data[$name] = str_replace("\r",'',$data[$name]);
			$data[$name] = str_replace(array("\n"," "),array('<br>','&nbsp;'),$data[$name]);
		}
		if (!$attr['null'] && !$data[$name] && $attr['type'] != 'checkbox') 
		{
			$errors[$name] = '不能为空';
		}
	}
}//end of foreach