<?php
	enum CommuniKit_Error_Type
	{
		case Error;
		case Warning;
		case Info;
	}

	class CommuniKit_Error
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
		CommuniKit_Error::add_message ($error);
	}

	function comk_get_errors ()
	{
		return CommuniKit_Error::get_messages ();
	}

	function comk_error_count ()
	{
		return CommuniKit_Error::count ();
	}