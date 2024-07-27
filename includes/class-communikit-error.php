<?php
	class Communikit_Error
	{
		private static $messages = array ();
		public static function add_message (string $message)
		{
            self::$messages[] = $message;
		}

		public static function get_messages () : array
		{
			$ret = self::$messages;
			self::$messages = array ();

            return $ret;
		}

		public static function get_last_message () : string
		{
			return end(self::$messages);
		}

		public static function count () : int
		{
			return count (self::$messages);
		}
	}

	function comk_add_error ($error)
	{
		Communikit_Error::add_message ($error);
	}

	function comk_get_errors ()
	{
		return Communikit_Error::get_messages ();
	}

	function comk_error_count ()
	{
		return Communikit_Error::count ();
	}