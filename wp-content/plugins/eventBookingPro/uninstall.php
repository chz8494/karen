<?php
if (!defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')){
  die();
}

$addons = get_option('active_plugins');
foreach ($addons as $addon) {
  if (strpos($addon, "eventBookingPro") === false) continue;

  if(is_plugin_active($addon)){
    deactivate_plugins($addon);
  }
}

?>
