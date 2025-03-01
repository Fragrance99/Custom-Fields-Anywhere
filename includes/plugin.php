<?php
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
        // Check for required PHP and Elementor versions.
        if (!$this->is_compatible()) {
            return;
        }

        // Load dependencies (ONLY helpers & controls, NOT widgets)
        $this->load_dependencies();

        // Register Elementor Widgets only when Elementor is ready
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Load JavaScript for Elementor & Admin Pages
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }

    /**
     * Load JavaScript for Elementor Editor & WP Admin.
     */
    public function enqueue_admin_scripts()
    {
        wp_enqueue_script(
            'cfa-post-selector',
            plugins_url('assets/js/post-selector.js', dirname(__FILE__, 1)), // ✅ Corrected path
            ['jquery'],
            self::VERSION,
            true
        );

        wp_localize_script('cfa-post-selector', 'customFieldsAnywhere', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cfa_nonce')
        ]);
    }

    private function load_dependencies()
    {
        require_once __DIR__ . '/helpers/helper-functions.php';
        require_once __DIR__ . '/controls/post-type-control.php';
        require_once __DIR__ . '/controls/post-selector-control.php';
        require_once __DIR__ . '/controls/template-selector-control.php';
        require_once __DIR__ . '/ajax-handler.php';
    }

    public function is_compatible()
    {
        // Check PHP version.
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'php_version_notice']);
            return false;
        }

        // Check Elementor version.
        if (!did_action('elementor/loaded') || !version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'elementor_version_notice']);
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

    public function elementor_version_notice()
    {
        echo '<div class="notice notice-warning is-dismissible"><p>';
        echo esc_html__('Custom Fields Anywhere requires Elementor version ' . self::MINIMUM_ELEMENTOR_VERSION . ' or higher.', 'custom-fields-anywhere');
        echo '</p></div>';
    }

    public function register_widgets($widgets_manager)
    {
        // Load widget file ONLY when Elementor is ready
        require_once __DIR__ . '/widgets/custom-field-template-wrapper.php';

        // Register widget
        $widgets_manager->register(new Widgets\Custom_Field_Template_Wrapper());
    }
}
