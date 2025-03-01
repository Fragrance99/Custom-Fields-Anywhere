<?php
/**
 * Plugin Name: Custom Fields Anywhere
 * Description: Wrapper around Elementor Templates to enable display of custom fields (e.g., Pods).
 * Version:     1.0.0
 * Author:      Fragrance99
 * Author URI:  https://github.com/fragrance99
 * Text Domain: custom-fields-anywhere
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Check if Elementor is installed and active.
 */
function custom_fields_anywhere_is_elementor_active()
{
	return did_action('elementor/loaded');
}

/**
 * Initialize the plugin.
 */
function custom_fields_anywhere_load()
{
	// Check for Elementor before loading the plugin
	if (!custom_fields_anywhere_is_elementor_active()) {
		add_action('admin_notices', 'custom_fields_anywhere_elementor_missing_notice');
		return;
	}

	// Load the main plugin class
	require_once __DIR__ . '/includes/plugin.php';
	\Custom_Fields_Anywhere\Plugin::instance();
}
add_action('plugins_loaded', 'custom_fields_anywhere_load');

/**
 * Show admin notice if Elementor is not active.
 */
function custom_fields_anywhere_elementor_missing_notice()
{
	echo '<div class="notice notice-error"><p>';
	echo esc_html__('Custom Fields Anywhere requires Elementor to be installed and activated.', 'custom-fields-anywhere');
	echo '</p></div>';
}
