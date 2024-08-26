<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';

	$user_id = get_current_user_id ();
	$image_path = comku_get_user_image_url ($user_id);
	$image_path_alt = comku_get_user_image_fallback ();

	if (is_user_logged_in ())
	{
?>
		<div class="comk-box_edit_outer_block">
			<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data">
				<div class="comk-box_edit_inner_block">
					<figure class="comk-box_edit_figure">
						<img class="comk-box_edit_image_preview" src="<?php echo $image_path; ?>" />
						<figcaption><?php print (__("Current", "communikit")); ?></figcaption>
					</figure>
					<figure class="comk-box_edit_figure">
						<img id="comk-box_edit_image_preview_target" class="comk-box_edit_image_preview" src="<?php echo $image_path_alt; ?>" />
						<figcaption><?php print (__("Upcoming", "communikit")); ?></figcaption>
					</figure>
				</div>
				<div>
					<div class="comk-box_edit_button">
						<input type="file" id="comk-box_edit_image_upload" name="comki-upload" />
					</div>
					<input type="hidden" name="comki-type" value="change_image">
					<div class="comk-box_edit_button">
						<input type="submit" value="Change image" />
					</div>
				</div>
			</form>
		</div>
<?php
	}
