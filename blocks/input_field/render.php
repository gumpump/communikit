<?php
	$field_JSON = (isset ($attributes["field_type"])) ? $attributes["field_type"] : '{"label":"Undefined","ident":"undefined"}';
	$field_strings = json_decode ($field_JSON);
	$field_name = "comki-" . $field_strings->ident;
	$field_required = (isset ($attributes["required"])) ? $attributes["required"] : false;
?>
<div class="comk-input">
	<input type="<?=$field_strings->type?>" id="<?=$field_name?>" name="<?=$field_name?>" value="" placeholder="" autocomplete="off" <?php if ($field_required) { echo "required"; } ?> />
	<label for="<?=$field_name?>" class="comk-input_label"><?=$field_strings->label?></label>
</div>
