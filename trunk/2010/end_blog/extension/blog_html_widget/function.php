<?php

function show_blog_widget($settings)
{
	$settings = eval($settings);
?>
	<div class="block">
		<h3><?php echo $settings['title'];?></h3>
		<div class="content">
			<?php eval($settings['content']);?>
		</div>
	</div>
<?php
}

?>