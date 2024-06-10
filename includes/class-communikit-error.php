<?php
	class Communikit_Error
	{
		private static $messages;
		public static function add_error_message ($message)
		{
			if (!isset(self::$messages))
			{
                self::$messages = array ();
			}

            self::$messages[] = $message;
		}

		public static function get_error_messages ()
		{
			$ret = self::$messages;
			unset (self::$messages);

            return $ret;
		}
	}

	function comk_add_error ($error)
	{
		Communikit_Error::add_error_message ($error);
	}

	function comk_get_errors ($error)
	{
		return Communikit_Error::get_error_messages ();
	}