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

		$upload = wp_handle_upload ($_FILES["comki-upload"], ["test_form" => false]);

		if (!empty ($upload["error"]))
		{
			comk_add_error (__("Could not upload file", "communikit"));
			return;
		}

		if (!str_contains ($upload["type"], "/image"))
		{
			comk_add_error (__("Uploaded file is not an image", "communikit"));
			return;
		}

		$username = get_user_by ("id", $user_id);

		$image_id = wp_insert_attachment (	array
											(
												"guid" => $upload["url"],
												"post_mime_type" => $upload["type"],
												"post_title" => __("Profile-picture ", "communikit") . $username->user_login,
												"post_content" => __("Current profile picture of " . $username->user_login, "communikit"),
												"post_status" => "inherit"
											),
											$upload["file"]);

		if (is_wp_error ($image_id) || $image_id === 0)
		{
			comk_add_error (__("Could not insert file into media library", "communikit"));
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

	function comku_get_user_page_slug ()
	{
		$page = get_post (get_option ("comk_page_user"));
		return $page->post_name;
	}

	function comku_get_edit_page_url ()
	{
		return get_permalink (get_option ("comk_page_edit"));
	}

	function comku_get_edit_page_slug ()
	{
		$page = get_post (get_option ("comk_page_edit"));
		return $page->post_name;
	}

	function comku_get_edit_image_url ()
	{
		// Prepare 
		$image_path_alt = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
		$image_path_alt .= "/wp-content/plugins/communikit/public/images/";
		$image_path_alt .= "edit_default.png";

		$options = json_decode (get_option ("comk_options"));
		return (($options->edit_image_id == -1) ? $image_path_alt : wp_get_attachment_image_url ($options->edit_image_id));
	}

	function comku_change_edit_image ()
	{
		require_once ABSPATH . "wp-admin/includes/file.php";

		$upload = wp_handle_upload ($_FILES["comka-edit_icon"], ["test_form" => false]);

		if (!empty ($upload["error"]))
		{
			comk_add_error (__("Could not upload file", "communikit"));
			return;
		}

		if (!str_contains ($upload["type"], "image/"))
		{
			comk_add_error (__("Uploaded file is not an image: " . $upload["type"], "communikit"));
			return;
		}

		$image_id = wp_insert_attachment (	array
											(
												"guid" => $upload["url"],
												"post_mime_type" => $upload["type"],
												"post_title" => __("Edit-icon ", "communikit"),
												"post_content" => __("Icon to show next to editable objects", "communikit"),
												"post_status" => "inherit"
											),
											$upload["file"]);

		if (is_wp_error ($image_id) || $image_id === 0)
		{
			comk_add_error (__("Could not insert file into media library", "communikit"));
			return;
		}

		require_once ABSPATH . "wp-admin/includes/image.php";

		wp_update_attachment_metadata (	$image_id,
										wp_generate_attachment_metadata (	$image_id,
																			$upload["file"]));

		$options = json_decode (get_option ("comk_options"));

		if ($options->edit_image_id != null)
		{
			wp_delete_attachment ((int)$options->edit_image_id);
		}

		$options = [];
		$options["edit_image_id"] = $image_id;
		update_option ("comk_options", json_encode ($options));
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