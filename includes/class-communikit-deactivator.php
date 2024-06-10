<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    Communikit
 * @subpackage Communikit/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Communikit
 * @subpackage Communikit/includes
 * @author     Wolfgang Neue <info@communikit.de>
 */
class Communikit_Deactivator
{
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate ()
	{
		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-options.php";
		Communikit_Options::unset_options ();

		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-pages.php";
		Communikit_Pages::remove_pages ();

		require_once plugin_dir_path (dirname (__FILE__)) . "includes/class-communikit-capabilities.php";
		Communikit_Capabilities::unset_roles ();
	}
}