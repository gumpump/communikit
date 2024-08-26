<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-form.php';

	$visibility = (isset ($block->context["communikit/form-context"]) ? $block->context["communikit/form-context"] : "both");

	if (comk_form_is_visible ($block->context["communikit/form-context"]))
	{
		$button_type = (isset ($attributes["button_type"])) ? $attributes["button_type"] : "submit";
		$button_label = (isset ($attributes["button_type"])) ? $attributes["button_label"] : "Button";
?>
<div class="comk-input">
	<input type="<?php echo $button_type; ?>" value="<?php echo $button_label; ?>"/>
</div>
<?php
	}
?>
