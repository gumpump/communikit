<?php
	$img_classes = "comk-user_img";

	if (isset ($attributes["rounded"]) && $attributes["rounded"])
	{
		$img_classes .= " comk-user_img_rounded";
	}

	$user = get_user_by ("slug", get_query_var ("user-name"));

	if ($user === false)
	{
?>
<div>
	<p><?php print ("Something went wrong"); /* TODO: Translate */ ?></p>
</div>
<?php
	}

	else
	{
		$user_id = ($user === false) ? 0 : $user->ID;

		require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
		$image_path = comku_get_user_image_url ($user_id);
?>
<div class="comk-outer_block">
	<img class="<?=$img_classes?>" src="<?=$image_path?>">
	<?php
		if ($user_id == get_current_user_id ())
		{
			$edit_image = comku_get_edit_image_url ();
	?>
		<a href="#"><img class="comk-user_edit" src="<?php print ($edit_image); ?>" /></a>
	<?php
		}
	?>
</div>
<?php
	}
?>
