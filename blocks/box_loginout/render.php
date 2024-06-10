<?php
	// If session is active, show username, profile pic and log out form
	if (is_user_logged_in ())
	{
		// Get the username
		$username = wp_get_current_user ();

		// Get the profile image url
		require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
		$image_path = comku_get_user_image_url ($username->ID);

		$link_to_profile = get_permalink (get_option ("comk_page_user")) . $username->user_login;

		// All following html tags get their styles from the public css of CommuniKit
?>
<div class="comk-box_loginout_outer_block">
	<div class="comk-box_loginout_inner_block">
		<p class="comk-box_loginout_username"><?=$username->display_name?></p>
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
			<input type="hidden" name="comki-type" value="log_out" />
			<input type="submit" value="<?php print (__("Log out", "communikit")); ?>" />
		</form>
	</div>
	<a href="<?=$link_to_profile?>">
		<img class="comk-box_loginout_img" src="<?=$image_path?>" />
	</a>
</div>
<?php
	}

	// If session isn't active, show log in form
	else
	{
?>
<div class="comk-box_loginout_outer_block">
	<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
		<div class="comk-input">
			<input type="text" name="comki-username" placeholder="" autocomplete="off" required />
			<label for="comki-username" class="comk-input_label"><?php print (__("Username", "communikit")); ?></label>
		</div>
		<div class="comk-input">
			<input type="password" name="comki-password" placeholder="" autocomplete="off" required />
			<label for="comki-password" class="comk-input_label"><?php print (__("Password", "communikit")); ?></label>
		</div>
		<input type="hidden" name="comki-type" value="log_in" />
		<input type="submit" value="Log in" />
	</form>
</div>
<?php
	}
