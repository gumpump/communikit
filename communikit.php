<?php

/**
 *
 * @link              https://communikit.de
 * @since             0.1.0
 * @package           Communikit
 *
 * @wordpress-plugin
 * Plugin Name:       CommuniKit
 * Plugin URI:        https://communikit.de
 * Description:       Bla
 * Version:           0.1.0
 * Author:            Wolfgang Neue
 * Author URI:        https://communikit.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       communikit
 * Domain Path:       /languages
 */

if (!defined ('WPINC'))
{
	die;
}

define ("COMMUNIKIT_VERSION", "0.1.0");

function activate_communikit ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-communikit-activator.php';
	Communikit_Activator::activate ();
}

function deactivate_communikit ()
{
	require_once plugin_dir_path (__FILE__) . 'includes/class-communikit-deactivator.php';
	Communikit_Deactivator::deactivate ();
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

require plugin_dir_path (__FILE__) . 'includes/class-communikit.php';

function run_communikit ()
{
	$plugin = new Communikit ();
	$plugin->run ();
}

run_communikit ();