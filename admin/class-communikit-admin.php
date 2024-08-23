<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/admin
 * @author     Wolfgang Neue <info@communikit.de>
 */
class CommuniKit_Admin
{	
	/**
	 * Add the options page
	 * 
	 * @since 1.0.0
	 */
	public function menu ()
	{
		add_submenu_page (	"users.php",
							"CommuniKit - " . __("Options", "communikit"),
							"CommuniKit",
							"manage_options",
							sanitize_key ("comka_settings"),
							array ($this, "menu_load"));
	}
	
	/**
	 * Load the main menu
	 * 
	 * @since 1.0.0
	 */
	public function menu_load ()
	{
	    require_once plugin_dir_path (__FILE__) . "partials/communikit-admin-main.php";
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles ()
	{
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CommuniKit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CommuniKit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style ("communikit", plugin_dir_url ( __FILE__ ) . 'css/communikit-admin.css', array ());


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts ()
	{
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CommuniKit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CommuniKit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script ("communikit", plugin_dir_url( __FILE__ ) . 'js/communikit-admin.js', array( 'jquery' ));
	}
}
