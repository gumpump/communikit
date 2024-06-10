<?php
	require_once plugin_dir_path ( __FILE__ ) . "class-communikit-error.php";

	function comku_get_user_image_url ($user_id)
	{
		$usermeta = get_user_meta ($user_id, "comk_usermeta", true);

		$image_path_alt = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
		$image_path_alt .= "/wp-content/plugins/communikit/public/images/";
		$image_path_alt .= "profile_default.png";

		if (is_string ($usermeta) && !empty ($usermeta))
		{
			$usermeta_dec = json_decode ($usermeta);

			if ($usermeta_dec !== null)
			{
				$image_path = wp_get_attachment_image_url ($usermeta_dec->image_id);

				if ($image_path === false)
				{
					$image_path = $image_path_alt;
				}
			}

			else
			{
				$image_path = $image_path_alt;
			}
		}

		else
		{
			$image_path = $image_path_alt;
		}

		return $image_path;
	}

	function comku_change_user_image ($user_id)
	{
		require_once ABSPATH . "wp-admin/includes/file.php";

		// TODO: Check if the file really is an image
		$upload = wp_handle_upload ($_FILES["comki-upload"], ["test_form" => false]);
		// TODO: Look up $upload["type"]

		if (!empty ($upload["error"]))
		{
			// TODO: Translate
			comk_add_error ("Could not upload file");
			return;
		}

		$username = get_user_by ("id", $user_id);

		// TODO: Fill attachment with meaningful data
		// TODO: Translate
		$image_id = wp_insert_attachment (	array
											(
												"guid" => $upload["url"],
												"post_mime_type" => $upload["type"],
												"post_title" => "Profile-picture " . $username->user_login,
												"post_content" => "",
												"post_status" => "inherit"
											),
											$upload["file"]);

		if (is_wp_error ($image_id) || $image_id === 0)
		{
			// TODO: Translate
			comk_add_error ("Could not insert file into media library");
			return;
		}

		require_once ABSPATH . "wp-admin/includes/image.php";

		wp_update_attachment_metadata (	$image_id,
										wp_generate_attachment_metadata (	$image_id,
																			$upload["file"]));

		$current_meta = get_user_meta ($user_id, "comk_usermeta", true);

		$current_meta_json = json_decode ($current_meta);

		if ($current_meta_json != null)
		{
			wp_delete_attachment ((int)$current_meta_json->image_id);
		}

		$usermeta = [];
		$usermeta["image_id"] = $image_id;
		update_user_meta ($user_id, "comk_usermeta", json_encode ($usermeta));
	}

	function comku_get_user_page_url ()
	{
		return get_permalink (get_option ("comk_page_user"));
	}

	function comku_get_edit_page_url ()
	{
		return get_permalink (get_option ("comk_page_edit"));
	}

	function comku_get_edit_image_url ()
	{
		// Prepare 
		$image_path_alt = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
		$image_path_alt .= "/wp-content/plugins/communikit/public/images/";
		$image_path_alt .= "edit_default.png";

		return $image_path_alt;
	}

	function comku_get_user_description ($user_id)
	{
		$description = get_user_meta ($user_id, "description", true);

		return ($description === false) ? "" : $description;
	}

	function comku_change_user_description ($user_id)
	{
		update_user_meta ($user_id, "description", sanitize_textarea_field ($_REQUEST["comki-bio"]));
	}