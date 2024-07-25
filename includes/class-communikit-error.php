<?php
	class Communikit_Error
	{
		private static $messages;
		public static function add_message (string $message)
		{
			if (!isset (self::$messages))
			{
                self::$messages = array ();
			}

            self::$messages[] = $message;
		}

		public static function get_messages () : array
		{
			$ret = self::$messages;
			unset (self::$messages);

            return $ret;
		}

		public static function get_last_message () : string
		{
			if (!isset (self::$messages))
			{
				return "";
			}

			return end(self::$messages);
		}
	}

	function comk_add_error ($error)
	{
		Communikit_Error::add_message ($error);
	}

	function comk_get_errors ($error)
	{
		return Communikit_Error::get_messages ();
	}