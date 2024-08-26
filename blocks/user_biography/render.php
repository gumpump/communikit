<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-form.php';

	$visibility = (isset ($block->context["communikit/form-context"]) ? $block->context["communikit/form-context"] : "both");

	if (comk_form_is_visible ($visibility))
	{
		require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';

		$user = false;
		$user_id = false;
		$description = __("Could not load description", "communikit");

		switch ("Profile")
		{
			case "Profile":
			{
				$user = get_user_by ("slug", get_query_var ("user-name"));
				$user_id = ($user === false) ? false : $user->ID;
				$description = comku_get_user_description ($user_id);
				break;
			}

			case "Form":
			{
				if (is_user_logged_in ())
				{
					$user = wp_get_current_user ();
					$user_id = $user_id = ($user === false) ? false : $user->ID;
					$description = comku_get_user_description ($user_id);
				}

				break;
			}
		}
?>
<div <?php echo get_block_wrapper_attributes (); ?>>
	<span><?php print (sanitize_textarea_field ($description)); ?></span>
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
<?php
	}
?>
