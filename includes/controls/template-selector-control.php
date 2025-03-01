<?php
namespace Custom_Fields_Anywhere\Controls;

use Elementor\Controls_Manager;
use Custom_Fields_Anywhere\Helpers\Helper_Functions;

if (!defined('ABSPATH')) {
    exit;
}

class Template_Selector_Control
{
    public static function register($widget)
    {
        $widget->add_control(
            'template_id',
            [
                'label' => esc_html__('Choose a Template', 'custom-fields-anywhere'),
                'type' => Controls_Manager::SELECT2,
                'options' => Helper_Functions::get_elementor_templates(),
                'label_block' => true,
                'placeholder' => esc_html__('Start typing template name', 'custom-fields-anywhere'),
            ]
        );
    }
}
