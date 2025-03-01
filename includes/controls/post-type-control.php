<?php
namespace Custom_Fields_Anywhere\Controls;

use Elementor\Controls_Manager;
use Custom_Fields_Anywhere\Helpers\Helper_Functions;

if (!defined('ABSPATH')) {
    exit;
}

class Post_Type_Control
{
    public static function register($widget)
    {
        $widget->add_control(
            'post_type',
            [
                'label' => esc_html__('Choose Post Type', 'custom-fields-anywhere'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper_Functions::get_post_types(),
                'label_block' => true,
                'default' => 'post',
            ]
        );
    }
}
