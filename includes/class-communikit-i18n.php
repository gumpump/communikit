<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 * @author     Wolfgang Neue <info@communikit.de>
 */
class CommuniKit_i18n
{
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain ()
	{
		load_plugin_textdomain ('communikit', false,
								dirname (dirname (plugin_basename (__FILE__))) . '/languages/');
	}
}