<?php
	function comkb_add_filters ()
	{
		add_filter ("block_categories_all", function ($categories)
											{
												array_push ($categories,
															array
															(
																"slug" => "comkb_category_gen",
																"title" => "CommuniKit - General"
															));

												array_push ($categories,
															array
															(
																"slug" => "comkb_category_form",
																"title" => "CommuniKit - Form"
															));

												array_push ($categories,
															array
															(
																"slug" => "comkb_category_user",
																"title" => "CommuniKit - User"
															));

												array_push ($categories,
															array
															(
																"slug" => "comkb_category_box",
																"title" => "CommuniKit - Boxes"
															));

												return $categories;
											});

		// Insert "pre_render_block" and manipulate various author blocks
		// Don't call "render_block" inside of "pre_render_block", it will destroy the universe
		
		// "pre_render_block" is a pile of shit and should not be used because it is actually useless. It just doesn't work at all.
	}

	function comkb_add_blocks ()
	{
		register_block_type (__DIR__ . "/error_view");

		register_block_type (__DIR__ . "/input_form");
		register_block_type (__DIR__ . "/input_field");
		register_block_type (__DIR__ . "/input_upload");

		register_block_type (__DIR__ . "/user_image");
		register_block_type (__DIR__ . "/user_name");
		register_block_type (__DIR__ . "/user_biography");

		register_block_type (__DIR__ . "/box_loginout");
		register_block_type (__DIR__ . "/box_edit_image");
		register_block_type (__DIR__ . "/box_edit_biography");
	}