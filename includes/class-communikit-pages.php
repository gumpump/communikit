<?php
	require_once ABSPATH . "wp-admin/includes/post.php";

	class Communikit_pages
	{
		public static function add_pages ()
		{
			$page_user_content = file_get_contents (ABSPATH . "wp-content/plugins/communikit/templates/user-profile.php", true);

			// TODO: Translate
			$page_user =	array
							(
								"post_title" => "User",
								"post_content" => $page_user_content,
								"post_type" => "page",
								"post_status" => "publish"
							);

			$page_user_id = wp_insert_post ($page_user);

			if ($page_user_id === 0 ||
				is_wp_error ($page_user_id))
			{
				// TODO: Translate
				comk_add_error ("Could not insert default user profile page");
				return;
			}

			add_option ("comk_page_user", $page_user_id);

			$page_edit_content = file_get_contents (ABSPATH . "wp-content/plugins/communikit/templates/user-profile.php", true);

			// TODO: Translate
			$page_edit =	array
							(
								"post_title" => "Edit",
								"post_content" => $page_edit_content,
								"post_type" => "page",
								"post_status" => "publish"
							);

			$page_edit_id = wp_insert_post ($page_edit);

			if ($page_edit_id === 0 ||
				is_wp_error ($page_edit_id))
			{
				// TODO: Translate
				comk_add_error ("Could not insert default edit page");
				return;
			}

			add_option ("comk_page_edit", $page_edit_id);
		}

		public static function remove_pages ()
		{
			remove_option ("comk_page_edit");
			remove_option ("comk_page_user");
		}
	}