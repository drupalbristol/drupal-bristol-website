<?php

$databases = array();

$settings['hash_salt'] = '';
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components'
];

$config_directories[CONFIG_SYNC_DIRECTORY] = '../config/sync';

if (file_exists('/var/www/site-php')) {
  require '/var/www/site-php/ansibletest/ansibletest-settings.inc';
}

if (file_exists($app_root . '/' . $site_path . '/settings.platformsh.php')) {
  include $app_root . '/' . $site_path . '/settings.platformsh.php';
}

if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
