<?php

/**
 * Fired during plugin activation
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 * @author     Wolfgang Neue <info@communikit.de>
 */
class CommuniKit_Activator
{
    public static function activate ()
    {
		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-capabilities.php";
		CommuniKit_Capabilities::set_roles ();

		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-pages.php";
		CommuniKit_Pages::add_pages ();

		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-options.php";
		CommuniKit_Options::set_options ();
	}
}
