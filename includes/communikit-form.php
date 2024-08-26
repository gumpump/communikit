<?php
	require_once plugin_dir_path ( __FILE__ ) . "class-communikit-error.php";
	require_once plugin_dir_path (__FILE__) . "communikit-user.php";
	
	function comk_form_handler ($type)
	{
		switch ($type)
		{
			case "log_in":
			{
				if (is_user_logged_in ())
				{
					comk_add_error (__("User already logged in", "communikit"), CommuniKit_Error_Type::Info);
                    return;
				}

				if (isset ($_REQUEST["comki-username"]) &&
					isset ($_REQUEST["comki-password"]))
				{
					$result = username_exists ($_REQUEST["comki-username"]);

					if ($result === false)
					{
						comk_add_error (__("Username already exists", "communikit"));
						return;
					}

					$credentials = [];
					$credentials["user_login"] = $_REQUEST["comki-username"];
					$credentials["user_password"] = $_REQUEST["comki-password"];
					$credentials["remember"] = false;

					$user = wp_signon ($credentials, false);

					if (is_wp_error ($user))
					{
						comk_add_error (__("Wrong username or wrong password", "communikit"));
						return;
					}

					else
					{
						wp_set_current_user ($user->ID);
					}

				}

				break;
			}

			case "log_out":
			{
				if (is_user_logged_in ())
				{
					wp_logout ();
				}

				break;
			}

			case "sign_in":
			{
				if (!isset ($_REQUEST["comki-username"]) ||
					!isset ($_REQUEST["comki-password"]) ||
					!isset ($_REQUEST["comki-email"]))
				{
					comk_add_error (__("Missing input field", "communikit"));
					return;
				}

				if (username_exists ($_REQUEST["comki-username"]))
				{
					comk_add_error (__("Username already exists", "communikit"));
					return;
				}

				if (!validate_username ($_REQUEST["comki-username"]))
				{
					comk_add_error (__("Invalid username", "communikit"));
					return;
				}

				if (email_exists ($_REQUEST["comki-email"]))
				{
					comk_add_error (__("Email address already exists", "communikit"));
					return;
				}

				if (!is_email ($_REQUEST["comki-email"]))
				{
					comk_add_error (__("Invalid email address", "communikit"));
					return;
				}

				$userdata = [];
				$userdata["user_login"] = $_REQUEST["comki-username"];
				$userdata["user_email"] = $_REQUEST["comki-email"];
				$userdata["user_pass"]	= $_REQUEST["comki-password"];
				$userdata["first_name"] = (isset ($_REQUEST["comki-firstname"])) ? $_REQUEST["comki-firstname"] : "";
				$userdata["last_name"]	= (isset ($_REQUEST["comki-lastname"])) ? $_REQUEST["comki-lastname"] : "";
				$userdata["show_admin_bar_front"] = "false"; // No boolean
				// TODO: Add "get_lowest_rank ()" or something like that
				$userdata["role"] = "comk-basic_user";

				$user_id = wp_insert_user ($userdata);

				if (is_wp_error ($user_id))
				{
					comk_add_error ($user_id->get_error_message);
					return;
				}

				if (!empty ($_FILES["comki-upload"]))
				{
					comku_change_user_image ($user_id);
				}

				break;
			}

			case "change_image":
			{
				$user_id = get_current_user_id ();

				if (!empty ($_FILES["comki-upload"]))
				{
					comku_change_user_image ($user_id);
				}

				break;
			}

			case "change_bio":
			{
				if (!isset ($_REQUEST["comki-bio"]))
				{
					comk_add_error (__("Could not find comki-bio input field", "communikit"));
					return;
				}

				$user_id = get_current_user_id ();

				comku_change_user_description ($user_id);

				break;
			}

			case "edit_data":
			{
				$userdata = wp_get_current_user ();

				if (isset ($_REQUEST["comki-email"]))
				{
					if (email_exists ($_REQUEST["comki-email"]) &&
						$_REQUEST["comki-email"] != $userdata->user_email)
					{
						comk_add_error (__("Email address already exists", "communikit"));
						return;
					}

					if (!is_email ($_REQUEST["comki-email"]))
					{
						comk_add_error (__("Invalid email address", "communikit"));
						return;
					}

					$userdata->user_email = $_REQUEST["comki-email"];
				}

				if (isset ($_REQUEST["comki-firstname"]))
				{
					$userdata->first_name = $_REQUEST["comki-firstname"];
				}

				if (isset ($_REQUEST["comki-lastname"]))
				{
					$userdata->last_name = $_REQUEST["comki-lastname"];
				}

				if (empty ($userdata->first_name) && empty ($userdata->last_name))
				{
					$userdata->display_name = $userdata->user_login;
				}

				else
				{
					$userdata->display_name = trim ($userdata->first_name . " " . $userdata->last_name);
				}

				wp_update_user ($userdata);

				break;
			}
		}
	}

	function comk_form_filler ($content)
	{
		$userdata = wp_get_current_user ();

		$new_content = [];

		$start = 0;
		$end = 0;

		while (true)
		{
			$start = strpos ($content, "<div", $end);

			if ($start === false)
			{
				break;
			}

			$end = strpos ($content, "</div>", $start);

			$sub = substr ($content, $start, $end + 6 - $start);
			$value = "";

			// I should optimize this
			// TODO: Optimize the search for fields to fill
			if (str_contains ($sub, "email"))
			{
				$value = $userdata->user_email;
			}

			else if (str_contains ($sub, "firstname"))
			{
				$value = $userdata->first_name;
			}

			else if (str_contains ($sub, "lastname"))
			{
				$value = $userdata->last_name;
			}

			$new_content[] = str_replace ('value=""', 'value="' . $value . '"', $sub);
		}

		return implode ("", $new_content);
	}

	function comk_form_is_visible (string $value) : bool
	{
		$visible = false;

		switch ($value)
		{
			case "both":
			{
				$visible = true;

				break;
			}

			case "logged":
			{
				if (is_user_logged_in ())
				{
					$visible = true;
				}

				break;
			}

			case "unlogged":
			{
				if (!is_user_logged_in ())
				{
					$visible = true;
				}

				break;
			}
		}

		return $visible;
	}