<?php
	$field_JSON = (isset ($attributes["field_type"])) ? $attributes["field_type"] : '{"label":"Undefined","ident":"undefined"}';
	$field_strings = json_decode ($field_JSON);
	$field_name = "comki-" . $field_strings->ident;
	$field_required = (isset ($attributes["required"])) ? $attributes["required"] : false;
?>
<div class="comk-input">
	<input type="<?php echo $field_strings->type; ?>" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" value="" placeholder="" autocomplete="off" <?php if ($field_required) { print (__("required", "communikit")); } ?> />
	<label for="<?php echo $field_name; ?>" class="comk-input_label"><?php echo $field_strings->label; ?></label>
</div>
