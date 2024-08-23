<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    CommuniKit
 * @subpackage CommuniKit/includes
 * @author     Wolfgang Neue <info@communikit.de>
 */
class CommuniKit
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CommuniKit_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct ()
	{
		$this->load_dependencies ();

		$this->set_locale ();
		$this->define_admin_hooks ();
		$this->define_public_hooks ();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - CommuniKit_Loader. Orchestrates the hooks of the plugin.
	 * - CommuniKit_i18n. Defines internationalization functionality.
	 * - CommuniKit_Admin. Defines all hooks for the admin area.
	 * - CommuniKit_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies ()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path (dirname (__FILE__)) . 'includes/class-communikit-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path (dirname (__FILE__)) . 'includes/class-communikit-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path (dirname (__FILE__)) . 'admin/class-communikit-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path (dirname (__FILE__)) . 'public/class-communikit-public.php';

		$this->loader = new CommuniKit_Loader ();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CommuniKit_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{
		$plugin_i18n = new CommuniKit_i18n ();

		$this->loader->add_action ('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks ()
	{
		$plugin_admin = new CommuniKit_Admin ();

		$this->loader->add_action ("admin_menu", $plugin_admin, "menu");
		$this->loader->add_action ('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action ('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks ()
	{
		$plugin_public = new CommuniKit_Public ();

		$this->loader->add_action ('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action ('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run ()
	{
		$this->loader->run ();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    CommuniKit_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader ()
	{
		return $this->loader;
	}
}