<?php
	$button_type = (isset ($attributes["button_type"])) ? $attributes["button_type"] : "submit";
	$button_label = (isset ($attributes["button_type"])) ? $attributes["button_label"] : "Button";
?>
<div class="comk-input">
	<input type="<?php echo $button_type; ?>" value="<?php echo $button_label; ?>"/>
</div>
