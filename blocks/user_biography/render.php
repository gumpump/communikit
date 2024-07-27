<?php
	$user = get_user_by ("slug", get_query_var ("user-name"));

	if ($user === false)
	{
?>
<div>
	<p><?php comk_add (__("Something went wrong", "communikit")); ?></p>
</div>
<?php
	}

	else
	{
		$description = ($user === false) ? __("No description available", "communikit") : $user->user_description;
?>
<div <?php get_block_wrapper_attributes (); ?>>
	<div>
		<span><?php print (sanitize_textarea_field ($description)); ?></span>
		<?php
			if ($user->ID == get_current_user_id ())
			{
				require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
				$edit_image = comku_get_edit_image_url ();
				$edit_path	= comku_get_edit_page_url () . $user->user_login;
		?>
			<a class="comk-user_edit_link" href="<?php print ($edit_path); ?>"><img class="comk-user_edit_img" src="<?php print ($edit_image); ?>" /></a>
		<?php
			}
		?>
	</div>
</div>
<?php
}
?>
