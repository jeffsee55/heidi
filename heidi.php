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

defined('ABSPATH') or die('No script kiddies please!');

define('HEIDI_TEXT_DOMAIN', 'heidi');
define('HEIDI_VERSION', '1.0');
define('HEIDI_PATH', plugin_dir_path(__FILE__));
define('HEIDI_DIR', get_site_url() . '/wp-content/plugins/heidi');
define('HEIDI_PLUGIN_PATH', HEIDI_PATH . '/plugin/');
define('HEIDI_PLUGIN_DIR', HEIDI_DIR . '/plugin/');
define('HEIDI_RESOURCE_PATH', HEIDI_PATH . '/resources/');
define('HEIDI_RESOURCE_DIR', HEIDI_DIR . '/resources/');

require __DIR__ . '/bootstrap.php';

$plugin = getPlugin();



add_action('plugins_loaded', function() {

    Heidi\Core\Router::load('routes.php');

});
