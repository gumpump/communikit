<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/public
 * @author     Wolfgang Neue <info@communikit.de>
 */
class CommuniKit_Public
{
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style ("communikit", plugin_dir_url (__FILE__) . 'css/communikit-public.css', array ());
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_enqueue_script ("communikit", plugin_dir_url (__FILE__) . 'js/communikit-public.js', array ('jquery'));
	}
}