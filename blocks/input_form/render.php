<?php
	// Get form type or set it to "sign_in" (Ternary operator)
	// "Ternary" ... fancy
	$form_type = (isset ($attributes["form_type"])) ? $attributes["form_type"] : "sign_in";

	// Declare the variable later holding the text shown on the submit button
	$submit_value = "";

	// Choose the right text to show on the submit button
	switch ($form_type)
	{
		// TODO: Translate
		case "log_in": { $submit_value = "Log in"; break; }
		case "log_out": { $submit_value = "Log out"; break; }
		case "sign_in": { $submit_value = "Sign in"; break; }
		case "edit_data": { $submit_value = "Save changes"; break; }
	}

	if (isset ($_REQUEST["comki-type"]) && $_REQUEST["comki-type"] == "sign_in" &&
		isset ($attributes["forwarding"]) && $attributes["forwarding"] == true &&
		isset ($attributes["post"]["url"]))
	{
		// TODO: Look up wp_safe_redirect
		wp_safe_redirect ($attributes["post"]["url"]);
	}

	$form_fields = "";

	if ($form_type == "edit_data")
	{
		require_once plugin_dir_path (__FILE__) . "../../includes/communikit-form.php";

		$form_fields = comk_form_filler ($content);
	}

	else
	{
		$form_fields = $content;
	}

	// All following html tags get their styles from the public css file of CommuniKit
?>
<form action="<?=$_SERVER["REQUEST_URI"]?>" method="POST" enctype="multipart/form-data">
	<?php print ($form_fields); ?>
	<div>
		<input type="hidden" name="comki-type" value="<?=$form_type?>" />
		<input type="submit" value="<?=$submit_value?>" />
	</div>
</form>
