<?php
namespace Custom_Fields_Anywhere\Controls;

use ElementorPro\Modules\QueryControl\Module as QueryModule;
use ElementorPro\Core\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class Post_Selector_Control
{
    public static function register($widget)
    {
        // Fetch allowed post types using Elementor Pro's method
        $allowed_post_types = Utils::get_public_post_types();

        $widget->add_control(
            'post_id',
            [
                'label' => esc_html__('Choose a Post', 'custom-fields-anywhere'),
                'type' => QueryModule::QUERY_CONTROL_ID,
                'label_block' => true,
                'multiple' => false, // Only allow selecting one post
                'autocomplete' => [
                    'object' => QueryModule::QUERY_OBJECT_POST,
                    'display' => 'detailed',
                    'query' => [
                        'post_type' => array_keys($allowed_post_types), // Fetch only allowed post types
                        'post_status' => 'publish',
                    ],
                ],
            ]
        );
    }
}
