<?php

namespace Custom_Fields_Anywhere\Controls;

use Elementor\Controls_Manager;
use ElementorPro\Core\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class Post_Type_Selector_Control
{
    public static function register($widget)
    {
        // Fetch allowed post types using Elementor's method
        $allowed_post_types = Utils::get_public_post_types();

        $widget->add_control(
            'post_type',
            [
                'label' => esc_html__('Select Post Type', 'custom-fields-anywhere'),
                'type' => Controls_Manager::SELECT,
                'options' => $allowed_post_types, // List of post types
                'default' => key($allowed_post_types), // Set the first post type as default
                'label_block' => true,
            ]
        );
    }
}
