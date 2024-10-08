<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-form.php';

	$visibility = (isset ($attributes["visibility"])) ? $attributes["visibility"] : "both";

	if (comk_form_is_visible ($visibility))
	{
		// Get form type or set it to "sign_in" (Ternary operator)
		// "Ternary" ... fancy
		$form_type = (isset ($attributes["form_type"])) ? $attributes["form_type"] : "sign_in";

		if (isset ($_REQUEST["comki-type"]) && $_REQUEST["comki-type"] == "sign_in" &&
			isset ($attributes["forwarding"]) && $attributes["forwarding"] == true &&
			isset ($attributes["post"]["url"]))
		{
			wp_safe_redirect ($attributes["post"]["url"]);
		}

		$form_fields = "";

		if ($form_type == "edit_data")
		{
			$form_fields = comk_form_filler ($content);
		}

		else
		{
			$form_fields = $content;
		}

		// All following html tags get their styles from the public css file of CommuniKit
?>
<form action="<?=$_SERVER["REQUEST_URI"]?>" method="POST" enctype="multipart/form-data">
	<?php echo $form_fields; ?>
	<div>
		<input type="hidden" name="comki-type" value="<?php echo $form_type; ?>" />
	</div>
</form>
<?php
	}
?>
