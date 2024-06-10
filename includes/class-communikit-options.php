<?php
	class Communikit_Options
	{
		private static $template_options = array (
			"edit_image_id" => -1
		);
		public static function set_options ()
		{
			add_option ("comk_options", json_encode (Communikit_Options::$template_options));
		}

		public static function unset_options ()
		{
			delete_option ("comk_options");
		}
	}