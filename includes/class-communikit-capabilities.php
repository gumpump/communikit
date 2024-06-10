<?php
	/*
		In the future this file will contain all roles and capabilities
		required by CommuniKit. This will help integrating the users
		created by CommuniKit-forms into the WordPress world.
		CommuniKit will destroy BuddyPress!


		I have to remove this comment before release.
	*/

	class Communikit_Capabilities
	{
		public static function set_roles ()
		{
			// TODO: Translate
			add_role ("comk-basic_user", "Basic user", array ());
		}

		public static function unset_roles ()
		{
			remove_role ("comk-basic_user");
		}
	}