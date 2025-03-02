<?php
/**
 * Plugin Name: Custom Fields Anywhere
 * Description: Wrapper around Elementor Templates to enable display of custom fields (e.g., Pods).
 * Version:     1.0.0
 * Author:      Fragrance99
 * Author URI:  https://github.com/fragrance99
 * Text Domain: custom-fields-anywhere
 * License:     GPL v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Requires Plugins: elementor, elementor-pro
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 *
 * @package   CustomFieldsAnywhere
 * @author    Fragrance99
 * @license   GPL-3.0-or-later https://www.gnu.org/licenses/gpl-3.0.html
 * @link      https://github.com/fragrance99/custom-fields-anywhere
 * @since     1.0.0
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