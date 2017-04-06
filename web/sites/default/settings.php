<?php

$databases = array();

$config_directories['sync'] = '../config/sync';

$settings['hash_salt'] = '';
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components'
];

if (file_exists($file = __DIR__ . '/local.settings.php')) {
  include $file;
}
