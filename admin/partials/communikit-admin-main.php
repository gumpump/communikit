<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://communikit.de
 * @since      1.0.0
 *
 * @package    Communikit
 * @subpackage Communikit/admin/partials
 */

$default_tab = null;
$tab = isset ($_GET['tab']) ? $_GET['tab'] : $default_tab;
$page_title = esc_html (get_admin_page_title ());
$plugin_name = "communikit";
$key = "comka_settings";
?>
<div class="wrap">
	<h1 class="comk_common"><?=$page_title?></h1>
	<nav class="nav-tab-wrapper">
		<a href="?page=<?php print ($key); ?>" class="nav-tab <?php if ($tab === null) {?>nav-tab-active<?php }?>"><?php echo __("General", $plugin_name)?></a>
		<a href="?page=<?php print($key); ?>&tab=user_list" class="nav-tab <?php if ($tab === "user_list") {?>nav-tab-active<?php }?>"><?php echo __("User list", $plugin_name)?></a>
	</nav>
	<div class="comk_spacer"></div>
	<div class="tab-content">
		<?php switch ($tab) { case "user_list":?>
			<!-- User list -->
		<?php break;?>
		<?php default:?>
			<!-- General -->
			<?php require_once plugin_dir_path (__FILE__) . "communikit-admin-general.php"; ?>
		<?php break; }?>
	</div>
</div>