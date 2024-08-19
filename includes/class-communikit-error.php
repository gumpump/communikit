<?php
	enum CommuniKit_Error_Type : string
	{
		case Error = "E";
		case Warning = "W";
		case Info = "I";
	}

	class CommuniKit_Error
	{
		private static $messages = array ();
		public static function add_message (string $message, CommuniKit_Error_Type $type)
		{
            self::$messages[] = array ("message" => $message, "type" => $type);
		}

		public static function get_messages () : array
		{
			$ret = self::$messages;
			self::$messages = array ();
            return $ret;
		}

		public static function get_last_message () : string
		{
			return end (self::$messages);
		}

		public static function count () : int
		{
			return count (self::$messages);
		}
	}

	function comk_add_error (string $message, CommuniKit_Error_Type $type = CommuniKit_Error_Type::Error)
	{
		CommuniKit_Error::add_message ($message, $type);
	}

	function comk_get_errors ()
	{
		return CommuniKit_Error::get_messages ();
	}

	function comk_error_count () : int
	{
		return CommuniKit_Error::count ();
	}