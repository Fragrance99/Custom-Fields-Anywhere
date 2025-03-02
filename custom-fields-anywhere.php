<?php
/**
 * Plugin Name: Custom Fields Anywhere
 * Description: Wrapper around Elementor Templates to enable display of custom fields (e.g., Pods).
 * Version:     1.0.0
 * Author:      Fragrance99
 * Author URI:  https://github.com/fragrance99
 * Text Domain: custom-fields-anywhere
 *
 * Requires Plugins: elementor, elementor-pro
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Load the main plugin class.
 */
function custom_fields_anywhere_load()
{
	require_once __DIR__ . '/includes/plugin.php';
	\Custom_Fields_Anywhere\Plugin::instance();
}
add_action('plugins_loaded', 'custom_fields_anywhere_load');