<?php if ($_obj['item_id']){ ?>
<form action="admin.php?m=edit_item&p=item&item_id=<?php echo $_obj['item_id']; ?>&category_id=<?php echo $_obj['category_id']; ?>" method="post" enctype="multipart/form-data">
<?php } else { ?>
<form action="admin.php?m=new_item&p=item&category_id=<?php echo $_obj['category_id']; ?>" method="post"  enctype="multipart/form-data" >
<?php } ?>
	<table >
    	<tr>
        	<td valign="top">
				 所属栏目<span style="color:red">*</span>
			</td>
        	<td>
				<div><select name="category_id" >
                	<option value="0">PLEASE_SELECT</option>
                		<?php echo $_obj['category_tree']; ?>
                	</select>
				</div>
            </td>
       	</tr>
    
        <?php
/*
根据配置生成编辑页面的各个输入字段
*/
	foreach($_obj['fields'] as $name=>$data)
	{
		if (preg_match('/^__/',$name)) continue;
		echo "<tr><td>{$data[name]}";
		if (!$data['null']) echo '<span style="color:red">*</span>';
		echo "</td>";
		echo "<td>";
		$_style = ($data['width'])?'width:'.$data['width'].'px;':'width:600px;';
		$_style.= ($data['height'])?'height:'.$data['height'].'px;':'';
		
		//显示之前的预处理
		if ($data['prefilter'] && function_exists($data['prefilter']))
		{
			$_obj['content'][$name] = $data['prefilter']($_obj['content'][$name]);
		}
		
		//简单文字输入
		if ($data['type'] == 'text')
		{
			if ($data['disabled'])
			{
				echo "<input type='text' style='$_style' value='{$_obj[content][$name]}' disabled='disabled' />";
				echo "<input type='hidden' name='{$name}' style='$_style' value='{$_obj[content][$name]}' />";
			}
			else
			{
				echo "<input type='text' name='{$name}' style='$_style' value='{$_obj[content][$name]}' />";
			}
		}
		//复选框
		elseif ($data['type'] == 'checkbox')
		{
			echo "<input type='checkbox' name='{$name}' ";
			if ($_obj[content][$name]) echo " checked='checked' ";
			if ($data['disabled']) echo ' disabled="disabled" ';
			echo " />";
		}
		//文件
		elseif ($data['type'] == 'file')
		{
			if ($_obj[content][$name])
			{
				echo lang("uploaded_file").$_obj[content][$name]."<br />";
				echo "<input type='hidden' name='{$name}' value='{$_obj[content][$name]}' />";
			}
			echo "<input type='file' name='{$name}' style='{$_style}' />";
		}
		//多行文本
		elseif ($data['type'] == 'textarea')
		{
			if (!$data['height']) $_style.='height:300px;';
			echo "<textarea name='{$name}' style='$_style'>";
			echo htmlspecialchars($_obj[content][$name]);
			echo "</textarea>";
		}
		//下拉选框
		elseif ($data['type'] == 'select')
		{
			echo "<select name='{$name}' style='$_style'>";
			foreach($data['options'] as $_val=>$_name)
			{
				echo "<option ";
				if ($_obj['content']['b'][$name] == $_val) echo " selected='selected' ";
				echo " value='$_val'>$_name</option>";
			}
			echo "</select>";
		}
		//日期时间
		elseif ($data['type'] == 'datetime')
		{
			$t = $_obj[content][$name];
			if (is_array($t))
				$t = mktime($t['h'],$t['i'],$t['s'],$t['m'],$t['d'],$t['y']);
			if (!$t) $t = time();
			echo "<input type='text' size='4' value='".date('Y',$t)."' name='{$name}[y]'>年";
			echo "<input type='text' size='2' value='".date('m',$t)."' name='{$name}[m]'>月";
			echo "<input type='text' size='2' value='".date('d',$t)."' name='{$name}[d]'>日 ";
			echo "<input type='text' size='2' value='".date('H',$t)."' name='{$name}[h]'>时";
			echo "<input type='text' size='2' value='".date('i',$t)."' name='{$name}[i]'>分";
			echo "<input type='text' size='2' value='".date('s',$t)."' name='{$name}[s]'>秒";
		}
		//超文本编辑器
		elseif ($data['type'] == 'richtext')
		{
			if (!$data['width']) $_style .= 'width:700px;';
			if (!$data['height']) $_style.= 'height:400px;';
			?>
					<textarea style="<?php echo $_style;?>" name="<?php echo $name;?>" id="editor_<?php echo $name;?>" rich="true"><?php
					echo htmlspecialchars($_obj['content'][$name]);
					?></textarea>
					</td></tr>
					<tr>
						<Td>上传附件</td>
							<td><iframe src="admin.php?p=upload&for=<?php echo $name;?>" style="width:700px;height:30px;border:0;text-align:left;" border="0" frameborder="no" scrolling="no"></iframe>
			<?php
		}
		if ($data['description']) echo $data['description'];
		echo "</td></tr>\n";
	}
?>

        <tr>
        	<td colspan="2" align="center">
				<input type="submit" name="publish" value="直接发布" /> &nbsp;
				<input type="submit" name="saveonly" value="存草稿" /> &nbsp;
				<input type="button" value="返回"  onclick="if (confirm('是否确定要放弃修改？')) history.go(-1);" /> &nbsp;
			</td>
        </tr>
     </table>
     
        
   </form>