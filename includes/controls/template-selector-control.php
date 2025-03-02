<?php
/**
 * Custom Fields Anywhere - Elementor Addon
 *
 * @package    CustomFieldsAnywhere
 * @author     Fragrance99
 * @license    GPL-3.0-or-later https://www.gnu.org/licenses/gpl-3.0.html
 * @link       https://github.com/fragrance99/custom-fields-anywhere
 */
namespace Custom_Fields_Anywhere\Controls;

use ElementorPro\Modules\QueryControl\Controls\Template_Query;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use Elementor\Core\Base\Document;
use Elementor\Includes\Elements\Container;


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
                'type' => Template_Query::CONTROL_ID, // Uses Elementor's built-in template query
                'label_block' => true,
                'autocomplete' => [
                    'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
                    'query' => [
                        'post_status' => Document::STATUS_PUBLISH,
                        'meta_query' => [
                            [
                                'key' => Document::TYPE_META_KEY,
                                'value' => Container::get_type(), // Filters only container templates
                                'compare' => '='
                            ],
                        ],
                    ],
                ],
                'actions' => [
                    'new' => [
                        'visible' => true,
                        'document_config' => [
                            'type' => Container::get_type(), // Ensures only "container" templates can be created
                        ],
                        'after_action' => 'redirect',
                    ],
                    'edit' => [
                        'visible' => true,
                        'after_action' => 'redirect',
                    ],
                ],
                'frontend_available' => true,
            ]
        );
    }
}
