<?php
	$user = get_user_by ("slug", get_query_var ("user-name"));
	$username = comku_get_user_name ($user);
	$user_id = ($user === false) ? false : $user->ID;
?>
<h2 <?php echo get_block_wrapper_attributes (); ?>><?php echo $username; ?></h2>
	<?php
		if ($user_id == get_current_user_id ())
		{
			require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
			$edit_image = comku_get_edit_image_url ();
			$edit_path	= comku_get_edit_page_url () . $user->user_login;
	?>
		<a class="comk-user_edit_link" href="<?php print ($edit_path); ?>"><img class="comk-user_edit_img" src="<?php print ($edit_image); ?>" /></a>
	<?php
		}
	?>
