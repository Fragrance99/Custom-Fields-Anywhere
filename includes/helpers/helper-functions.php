<?php
namespace Custom_Fields_Anywhere\Helpers;

use WP_Query;

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Helper_Functions
{

    public static function get_post_types(): array
    {
        $excluded_post_types = ['elementor_library', 'attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'e-floating-buttons'];
        $custom_post_types = get_post_types(['public' => true, 'show_ui' => true], 'objects');

        $post_types = [];
        foreach ($custom_post_types as $post_type) {
            if (!in_array($post_type->name, $excluded_post_types)) {
                $post_types[$post_type->name] = $post_type->labels->singular_name;
            }
        }

        return $post_types;
    }

    public static function get_posts($post_type = 'post'): array
    {
        $args = [
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);
        $options = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $options[get_the_ID()] = get_the_title();
            }
            wp_reset_postdata();
        }

        return $options;
    }

    public static function get_elementor_templates(): array
    {
        $templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
        $options = [];

        if (!empty($templates)) {
            foreach ($templates as $template) {
                $options[$template['template_id']] = $template['title'];
            }
        }

        return $options;
    }
}
