<?php
	require_once plugin_dir_path (__FILE__) . "../../includes/class-communikit-error.php";

	$pages = get_pages ();
	$page_user_id = get_option ("comk_page_user");
	$page_edit_id = get_option ("comk_page_edit");
	$edit_image = comku_get_edit_image_url ();

	if (isset ($_REQUEST["submit"]))
	{
		update_option ("comk_page_user", ((isset ($_REQUEST["comka-user_page"])) ? $_REQUEST["comka-user_page"] : $page_user_id));
		update_option ("comk_page_edit", ((isset ($_REQUEST["comka-edit_page"])) ? $_REQUEST["comka-edit_page"] : $page_edit_id));

		if (isset ($_FILES["comka-edit_icon"]))
		{
			comku_change_edit_image ();
		}
	}
?>
<form method="post" action="?page=comka_settings" enctype="multipart/form-data">
	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row">
					<label for="comka-user_page"><?php print (__("Page to diplay as user profile", "communikit")); ?></label>
				</th>
				<td>
					<select id="comka-user_page" name="comka-user_page">
						<?php foreach ($pages as $p) { ?>
							<option value="<?php print ($p->ID); ?>" <?php if ($p->ID == $page_user_id){ print ("selected"); } ?>><?php print ($p->post_title); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="comka-edit_page"><?php print (__("Page to diplay for editing user profiles", "communikit")); ?></label>
				</th>
				<td>
					<select id="comka-edit_page" name="comka-edit_page">
						<?php foreach ($pages as $p)
						{ ?>
							<option value="<?php print($p->ID); ?>" <?php if ($p->ID == $page_edit_id)
							   {
								   print("selected");
							   } ?>><?php print($p->post_title); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="comka-edit_icon"><?php print (__('Image to display as "Edit"-symbol', "communikit")); ?></label>
				</th>
				<td>
					<img class="comk-edit_icon" src="<?php print ($edit_image); ?>" />
					<input type="file" id="comka-edit_icon" name="comka-edit_icon" accept="image/*" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<?php submit_button (); ?>
				</th>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="tab" value="general" />
</form>