<?php
/*
Plugin Name: Heidi Plugin Starter
Plugin URI:  https://jeffseedesigns.com
Description: A starter plugin using the blade templating engine
Version:     0.1
Author:      Jeff See
Author URI:  https//jeffseedesigns.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: heidi
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require __DIR__ . '/bootstrap.php';

$plugin = getPlugin();
