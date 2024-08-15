<?php
	class CommuniKit_Options
	{
		private static $template_options = array (
			"edit_image_id" => -1,
			"admin_img" => "off",
			"debug" => "off"
		);

		private static $current_options = array ();

		// Fired when plugin is activated
		public static function set_options ()
		{
			add_option ("comk_options", json_encode (self::$template_options));
		}

		// Fired when plugin is deactivated
		public static function unset_options ()
		{
			delete_option ("comk_options");
		}

		public static function load_options ()
		{
			self::$current_options = json_decode (get_option ("comk_options"), true);
		}

		public static function save_options ()
		{
			if (!empty (self::$current_options))
			{
				update_option ("comk_options", json_encode (self::$current_options));
			}
		}

		public static function get_option (string $option)
		{
			if (empty (self::$current_options))
			{
				self::load_options ();
			}

			return (isset (self::$current_options[$option])) ? self::$current_options[$option] : "";
		}

		public static function update_option (string $option, $value)
		{
			self::$current_options[$option] = $value;
		}
	}

	function comk_get_option ($option)
	{
		return CommuniKit_Options::get_option ($option);
	}

	function comk_update_option (string $option, $value)
	{
		CommuniKit_Options::update_option ($option, $value);
	}