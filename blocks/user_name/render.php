<?php
	$user = get_user_by ("slug", get_query_var ("user-name"));

	if ($user === false)
	{
?>
<div>
	<p><?php print (__("Something went wrong", "communikit")); ?></p>
</div>
<?php
	}

	else
	{
		$username = $user->display_name;
?>
<div>
<h2 class="comk-user_name"><?php print ($username); ?></h2>
	<?php
		if ($user->ID == get_current_user_id ())
		{
			require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
			$edit_image = comku_get_edit_image_url ();
	?>
		<img class="comk-user_edit" src="<?php print ($edit_image); ?>" />
	<?php
		}
	?>
</div>
<?php
	}
?>