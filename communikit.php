<?php

/**
 *
 * @link              https://communikit.de
 * @since             0.1.0
 * @package           CommuniKit
 *
 * @wordpress-plugin
 * Plugin Name:       CommuniKit
 * Plugin URI:        https://communikit.de
 * Description:       Let your users log in and control their profiles without access to the admin pages
 * Version:           0.5.1
 * Author:            Wolfgang Neue
 * Author URI:        https://communikit.de/
 * License:           MIT
 * License URI:       https://www.mit.edu/~amini/LICENSE.md
 * Text Domain:       communikit
 * Domain Path:       /languages
 */

if (!defined ('WPINC'))
{
	die;
}

define ("COMMUNIKIT_VERSION", "0.5.1");

require_once plugin_dir_path (__FILE__) . "includes/class-communikit-options.php";

function activate_communikit ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-communikit-activator.php';
	CommuniKit_Activator::activate ();
}

function deactivate_communikit ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-communikit-deactivator.php';
	CommuniKit_Deactivator::deactivate ();
}

register_activation_hook (__FILE__, 'activate_communikit');
register_deactivation_hook (__FILE__, 'deactivate_communikit');

/**
 * Registrating the blocks
 */
require_once plugin_dir_path (__FILE__) . "blocks/communikit-blocks.php";

function block_init ()
{
	comkb_add_filters ();
	comkb_add_blocks ();
}

add_action ("init", "block_init");

require_once plugin_dir_path (__FILE__) . "includes/communikit-user.php";

function redirect_permalink ()
{
	add_rewrite_rule (	basename (comku_get_user_page_url ()) . '/([a-zA-Z0-9\-]+)',
						'index.php?pagename=' . comku_get_user_page_slug () . '&user-name=$matches[1]', "top");
	add_rewrite_rule (	basename (comku_get_edit_page_url ()) . '/([a-zA-Z0-9\-]+)',
						'index.php?pagename=' . comku_get_edit_page_slug () . '&user-name=$matches[1]', "top");
	add_filter ("query_vars",	function ($query_vars)
								{
									$query_vars[] = "user-name";

									return $query_vars;
								});
}

add_action ("init", "redirect_permalink");

require_once plugin_dir_path (__FILE__) . "includes/communikit-form.php";

function session_init ()
{
	if (isset ($_REQUEST["comki-type"]))
	{
		comk_form_handler ($_REQUEST["comki-type"]);
	}
}

add_action ("init", "session_init");

function change_admin_img ()
{
	if (comk_get_option ("admin_img") == "on")
	{
		$image_url = comku_get_user_image_url (get_current_user_id ());

		?>
			<script>
				var user_image_url = "<?php echo $image_url; ?>";

				var images = document.getElementsByClassName ("avatar");

				for (var i of images)
				{
					i.setAttribute ("src", user_image_url);
				}
			</script>
		<?php
	}
}

add_action ("wp_after_admin_bar_render", "change_admin_img");

// TODO: Add script for replacing images in user list
// Look up "manage_users_custom_column"

function show_errors ()
{
	?>
		<script>
			var messages = <?php echo json_encode (comk_get_errors ()); ?>;
			var elements = document.getElementsByClassName ("comk-error_messages");

			var keys = Object.keys (elements);
			for (k in keys)
			{
				for (m in messages)
				{
					var icon = "";
					switch (messages[m]["type"])
					{
						case 'E':
							icon = "\u2716";
							break;
						case 'W':
							icon = "\u26A0";
							break;
						case 'I':
							icon = "\u2755";
							break;
					}

					const message = document.createElement ("div");
					message.classList.add ("comk-error_message");
					message.classList.add ("comk-error_message_" + messages[m]["type"]);
					message.appendChild (document.createTextNode (icon + " " + messages[m]["message"]));
					elements[k].appendChild (message);
				}
			}
		</script>
	<?php
}

if (comk_get_option ("debug") == "on")
{
	add_action ("wp_footer", "show_errors");
}

require plugin_dir_path (__FILE__) . 'includes/class-communikit.php';

function run_communikit ()
{
	$plugin = new CommuniKit ();
	$plugin->run ();
}

run_communikit ();