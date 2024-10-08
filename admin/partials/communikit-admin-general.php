<?php
	require_once plugin_dir_path (__FILE__) . "../../includes/class-communikit-error.php";
	require_once plugin_dir_path (__FILE__) . "../../includes/class-communikit-options.php";

	if (isset ($_REQUEST["submit"]))
	{
		update_option ("comk_page_user", ((isset ($_REQUEST["comka-user_page"])) ? $_REQUEST["comka-user_page"] : $page_user_id));
		update_option ("comk_page_edit", ((isset ($_REQUEST["comka-edit_page"])) ? $_REQUEST["comka-edit_page"] : $page_edit_id));
		comk_update_option ("admin_img", (isset ($_REQUEST["comka-admin_img"]) ? "on" : "off"));
		comk_update_option ("debug", (isset ($_REQUEST["comka-debug"]) ? "on" : "off"));

		if (isset ($_REQUEST["comka-edit_image_reset"]) and $_REQUEST["comka-edit_image_reset"] == 1)
		{
			comku_reset_edit_image ();
		}

		if (isset ($_FILES["comka-edit_icon"]) and $_FILES["comka-edit_icon"]["size"] > 0)
		{
			comku_change_edit_image ();
		}

		CommuniKit_Options::save_options ();
	}

	$pages = get_pages ();
	$page_user_id = get_option ("comk_page_user");
	$page_edit_id = get_option ("comk_page_edit");
	$edit_image = comku_get_edit_image_url ();
	$admin_img = comk_get_option ("admin_img");
	$debug = comk_get_option ("debug");

	$desc_admin_img	=	__(	"Replace the profile picture from Gravatar shown in your admin bar"
							. " with the one you chose in CommuniKit.", "communikit");
	$desc_debug		=	__(	"All kinds of messages will be shown in this options page"
							. " and wherever you placed a error viewer block.", "communikit");

	/*
	 * The following HTML code only shows when the associated tab is active
	*/
?>
<div class="comk-error_messages"></div>
<form id="comka-options_general_form" method="post" action="?page=comka_settings" enctype="multipart/form-data">
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
					<div>
						<img class="comk-edit_icon" id="comka-edit_icon_image" src="<?php print ($edit_image); ?>" />
						<div>
							<input class="comk-option_button" type="file" id="comka-edit_icon" name="comka-edit_icon" accept="image/*" />
							<input class="comk-option_button" type="button" onclick="Reset ()" id="comka-edit_icon_reset" name="comka-edit_icon_reset" value="<?php echo __("Reset icon", "communikit"); ?>"/>
							<span id="comka-edit_icon_reset_warning" style="display: none;"><?php echo __("Don't forget to save your changes after resetting", "communikit") ?></span>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="comka-admin_img"><?php print (__("Show profile picture on admin page", "communikit")); ?></label>
				</th>
				<td>
					<input type="checkbox" id="comka-admin_img" name="comka-admin_img" value="on" <?php echo ($admin_img == "on") ? "checked" : ""; ?>/>
					<p class="description"><?php echo $desc_admin_img; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="comka-debug"><?php echo __("Debug mode", "communikit"); ?></label>
				</th>
				<td>
					<input type="checkbox" id="comka-debug" name="comka-debug" value="on" <?php echo ($debug == "on") ? "checked" : ""; ?>/>
					<p class="description"><?php echo $desc_debug; ?></p>
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
<script>
	function Reset ()
	{
		const form = document.getElementById ("comka-options_general_form");
		const Input = document.createElement ("input");
		Input.type = "hidden";
		Input.name = "comka-edit_image_reset";
		Input.value = "1";
		form.appendChild (Input);
		document.getElementById("comka-edit_icon_image").src = "<?php echo comku_get_edit_image_fallback (); ?>";
		document.getElementById("comka-edit_icon").value = "";
		document.getElementById("comka-edit_icon_reset_warning").style.display = "unset";
	}
</script>