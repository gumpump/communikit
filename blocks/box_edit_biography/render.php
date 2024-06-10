<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
	$user_id = get_current_user_id ();
	$current_description = comku_get_user_description ($user_id);

	if (is_user_logged_in ())
	{
?>
	<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
	<div class="comk-box_edit_outer_block">
		<div>
			<textarea class="comk-box_edit_biography_text" name="comki-bio"><?php print ($current_description); ?></textarea>
		</div>
		<input type="hidden" name="comki-type" value="change_bio" />
		<div class="comk-box_edit_button">
			<input type="submit" value="Change description" />
		</div>
	</div>
	</form>
<?php
	}
