<?php
	require_once plugin_dir_path (__FILE__) . '../../includes/communikit-form.php';

	$visibility = (isset ($block->context["communikit/form-context"]) ? $block->context["communikit/form-context"] : "both");

	if (comk_form_is_visible ($visibility)
	{
?>
<div class="comk-input">
	<input type="file" name="comki-upload" accept="image/*" />
</div>
<?php
	}
?>
