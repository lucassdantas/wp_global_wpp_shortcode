<?php
/**
* Plugin Name: Global Phone Shortcode
* Plugin URI: https://github.com/lucassdantas/wp_global_wpp_shortcode.git
* License: GPLv2
* Description: Custom shortcode for show wpp phone on frontend and urls
* Version: 1.0.0
* Author: Lucas Dantas
* Author URI: https://www.linkedin.com/in/lucas-de-sousa-dantas/
**/

defined('ABSPATH') or die();
if(!function_exists('add_action'))die;

require_once plugin_dir_path(__FILE__). 'src/admin_page.php';
require_once plugin_dir_path(__FILE__). 'src/shortcodes.php';
