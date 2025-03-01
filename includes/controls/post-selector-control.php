<?php
namespace Custom_Fields_Anywhere\Controls;

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit;
}

class Post_Selector_Control
{
    public static function register($widget)
    {
        $widget->add_control(
            'post_id',
            [
                'label' => esc_html__('Choose a Post', 'custom-fields-anywhere'),
                'type' => Controls_Manager::SELECT2,
                'options' => [], // Will be dynamically updated
                'label_block' => true,
                'placeholder' => esc_html__('Start typing post title', 'custom-fields-anywhere'),
                'dynamic' => ['active' => true], // Ensures Elementor remembers the value
                'save_default' => true, // Saves the last selected value
            ]
        );
    }
}
