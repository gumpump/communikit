<?php
	$img_classes = "comk-user_img";

	if (isset ($attributes["rounded"]) && $attributes["rounded"])
	{
		$img_classes .= " comk-user_img_rounded";
	}

	$user = get_user_by ("slug", get_query_var ("user-name"));
	$user_id = ($user === false) ? false : $user->ID;

	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
	$image_path = comku_get_user_image_url ($user_id);
?>
<div class="comk-outer_block">
	<img class="<?=$img_classes?>" src="<?=$image_path?>">
	<?php
		if ($user_id == get_current_user_id ())
		{
			$edit_image = comku_get_edit_image_url ();
			$edit_path	= comku_get_edit_page_url () . $user->user_login;
	?>
		<a class="comk-user_edit_link" href="<?php print ($edit_path); ?>"><img class="comk-user_edit_img" src="<?php print ($edit_image); ?>" /></a>
	<?php
		}
	?>
</div>
