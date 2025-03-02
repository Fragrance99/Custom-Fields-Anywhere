<?php
/**
 * Custom Fields Anywhere - Elementor Addon
 *
 * @package    CustomFieldsAnywhere
 * @author     Fragrance99
 * @license    GPL-3.0-or-later https://www.gnu.org/licenses/gpl-3.0.html
 * @link       https://github.com/fragrance99/custom-fields-anywhere
 */
namespace Custom_Fields_Anywhere;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

final class Plugin
{
    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.25.0';
    const MINIMUM_PHP_VERSION = '7.4';

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        // Check compatibility before proceeding
        if (!$this->is_compatible()) {
            return;
        }

        // Load dependencies
        $this->load_dependencies();

        // Register Elementor Widgets only when Elementor is ready
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    private function load_dependencies()
    {
        require_once __DIR__ . '/controls/post-selector-control.php';
        require_once __DIR__ . '/controls/template-selector-control.php';
    }

    public function is_compatible()
    {
        // Check PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'php_version_notice']);
            return false;
        }

        // Check if Elementor is active
        if (!defined('ELEMENTOR_VERSION')) {
            add_action('admin_notices', [$this, 'elementor_missing_notice']);
            return false;
        }

        // Check if Elementor Pro is active
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            add_action('admin_notices', [$this, 'elementor_pro_missing_notice']);
            return false;
        }

        return true;
    }

    public function php_version_notice()
    {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo esc_html__('Custom Fields Anywhere requires PHP version ' . self::MINIMUM_PHP_VERSION . ' or higher.', 'custom-fields-anywhere');
        echo '</p></div>';
    }

    public function elementor_missing_notice()
    {
        echo '<div class="notice notice-error"><p>';
        echo esc_html__('Custom Fields Anywhere requires Elementor to be installed and activated.', 'custom-fields-anywhere');
        echo '</p></div>';
    }

    public function elementor_pro_missing_notice()
    {
        echo '<div class="notice notice-error"><p>';
        echo esc_html__('Custom Fields Anywhere requires Elementor Pro to be installed and activated.', 'custom-fields-anywhere');
        echo '</p></div>';
    }

    public function register_widgets($widgets_manager)
    {
        require_once __DIR__ . '/widgets/dynamic-template-wrapper.php';
        $widgets_manager->register(new Widgets\Dynamic_Template_Wrapper());
    }
}
