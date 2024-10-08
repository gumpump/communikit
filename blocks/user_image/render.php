<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-form.php';

	$visibility = (isset ($block->context["communikit/form-context"]) ? $block->context["communikit/form-context"] : "both");

	if (comk_form_is_visible ($visibility))
	{
		require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';

		$img_classes = "comk-user_img";

		if (isset ($attributes["rounded"]) && $attributes["rounded"])
		{
			$img_classes .= " comk-user_img_rounded";
		}

		$user = false;
		$user_id = false;
		$image_path = comku_get_user_image_fallback ();

		switch ("Form")
		{
			case "Profile":
			{
				$user = get_user_by ("slug", get_query_var ("user-name"));
				$user_id = ($user === false) ? false : $user->ID;
				$image_path = comku_get_user_image_url ($user_id);
				break;
			}

			case "Form":
			{
				if (is_user_logged_in ())
				{
					$user = wp_get_current_user ();
					$user_id = $user_id = ($user === false) ? false : $user->ID;
					$image_path = comku_get_user_image_url ($user_id);
				}

				break;
			}
		}
?>
<div <?php echo get_block_wrapper_attributes (["class" => "comk-user_img_box"]) ?>>
	<img class="<?php echo $img_classes; ?>" src="<?php echo $image_path; ?>">
	<?php
		if ("Form" == "Form" and $user !== false and $user_id == get_current_user_id ())
		{
			$edit_image = comku_get_edit_image_url ();
			$edit_path	= comku_get_edit_page_url () . $user->user_login;
	?>
		<a class="comk-user_edit_link" href="<?php echo $edit_path; ?>"><img class="comk-user_edit_img" src="<?php echo $edit_image; ?>" /></a>
	<?php
		}
	?>
</div>
<?php
	}
?>
