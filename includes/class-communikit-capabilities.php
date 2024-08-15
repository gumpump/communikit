<?php
	/*
		In the future this file will contain all roles and capabilities
		required by CommuniKit. This will help integrating the users
		created by CommuniKit-forms into the WordPress-world.
	*/

	class CommuniKit_Capabilities
	{
		public static function set_roles ()
		{
			add_role ("comk-basic_user", __("Basic user", "communikit"), array ());
		}

		public static function unset_roles ()
		{
			remove_role ("comk-basic_user");
		}
	}