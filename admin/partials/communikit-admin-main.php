<?php
$default_tab = null;
$tab = isset ($_REQUEST['tab']) ? $_REQUEST['tab'] : $default_tab;
$page_title = esc_html (get_admin_page_title ());
$key = "comka_settings";
?>
<div class="wrap">
	<h1 class="comk_common"><?=$page_title?></h1>
	<nav class="nav-tab-wrapper">
		<a href="?page=<?php print ($key); ?>&tab=general" class="nav-tab <?php if ($tab === "general" || $tab === null) {?>nav-tab-active<?php }?>"><?php echo __("General", "communikit")?></a>
		<a href="?page=<?php print ($key); ?>&tab=temp" class="nav-tab <?php if ($tab === "temp") {?>nav-tab-active<?php }?>"><?php echo __("Temp", "communikit")?></a>
	</nav>
	<div class="comk_spacer"></div>
	<div class="tab-content">
		<?php switch ($tab) { default: case "general": ?>
			<!-- General -->
			<?php require_once plugin_dir_path (__FILE__) . "communikit-admin-general.php"; ?>
		<?php break; ?>
		
		<?php case "temp":?>
			<!-- Temp -->
		<?php break; } ?>
		
	</div>
</div>