<?php
	require_once plugin_dir_path (__FILE__) . "../../includes/class-communikit-error.php";
	$pages = get_pages ();
	$page_user_id = get_option ("comk_page_user");
	$edit_image = comku_get_edit_image_url ();
?>
	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row">
					<!-- TODO: Translate -->
					<label for="comka-user_page">Page to diplay as user profile</label>
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
					<!-- TODO: Translate -->
					<label for="comka-edit_page">Page to diplay for editing user profiles</label>
				</th>
				<td>
					<select id="comka-edit_page" name="comka-edit_page">
						<?php foreach ($pages as $p)
						{ ?>
							<option value="<?php print($p->ID); ?>" <?php if ($p->ID == $page_user_id)
							   {
								   print("selected");
							   } ?>><?php print($p->post_title); ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<!-- TODO: Translate -->
					<label for="comka-edit_icon">Image to display as "Edit"-symbol</label>
				</th>
				<td>
					<img class="comk-edit_icon" src="<?php print ($edit_image); ?>" />
					<input type="file" id="comka-edit_icon" name="comka-edit_icon" accept="image/*" />
				</td>
			</tr>
		</tbody>
	</table>