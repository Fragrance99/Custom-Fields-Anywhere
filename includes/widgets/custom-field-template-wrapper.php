<?php
namespace Custom_Fields_Anywhere\Widgets;

use Elementor\Widget_Base;
use Custom_Fields_Anywhere\Controls\Post_Selector_Control;
use Custom_Fields_Anywhere\Controls\Template_Selector_Control;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Field_Template_Wrapper extends Widget_Base
{

    public function get_name()
    {
        return 'custom_field_template_wrapper';
    }

    public function get_title()
    {
        return esc_html__('Custom Field Template Wrapper', 'custom-fields-anywhere');
    }

    public function get_icon()
    {
        return 'eicon-text-field';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['custom', 'field', 'template', 'wrapper'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Settings', 'custom-fields-anywhere'),
            ]
        );

        // Register post and template selector controls
        Post_Selector_Control::register($this);
        Template_Selector_Control::register($this);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $post_id = !empty($settings['post_id']) ? intval($settings['post_id']) : 0;
        $template_id = !empty($settings['template_id']) ? intval($settings['template_id']) : 0;

        if (!$template_id || !$post_id) {
            echo '<p>Please select a valid post and template.</p>';
            return;
        }

        global $post;
        $original_post = $post;

        // Set the global post to the selected post
        $post = get_post($post_id);
        setup_postdata($post);

        // Render the Elementor template
        $shortcode = do_shortcode('[elementor-template id="' . $template_id . '"]');

        echo '<div class="cfa-wrapper">' . $shortcode . '</div>';

        // Reset the post data after rendering
        wp_reset_postdata();
        $post = $original_post;
    }

    protected function content_template()
    {
        ?>
        <div class="cfa-wrapper">
            <p><strong>Selected Post ID:</strong> <span>{{ settings.post_id }}</span></p>
            <p><strong>Selected Template ID:</strong> <span>{{ settings.template_id }}</span></p>
        </div>
        <?php
    }
}
