<?php
	$user = get_user_by ("slug", get_query_var ("user-name"));

	if ($user === false)
	{
?>
<div>
	<p><?php print ("Something went wrong"); /* TODO: Translate */ ?></p>
</div>
<?php
	}

	else
	{
		// TODO: Translate
		$description = ($user === false) ? "No description available" : $user->user_description;
?>
<div <?php get_block_wrapper_attributes (); ?>>
	<div>
		<span><?php print (sanitize_textarea_field ($description)); ?></span>
		<?php
			if ($user->ID == get_current_user_id ())
			{
				require_once plugin_dir_path (__FILE__) . '../../includes/communikit-user.php';
				$edit_image = comku_get_edit_image_url ();
		?>
			<img class="comk-user_edit" src="<?php print ($edit_image); ?>" />
		<?php
			}
		?>
	</div>
</div>
<?php
}
?>
