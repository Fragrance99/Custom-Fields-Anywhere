<?php
namespace Custom_Fields_Anywhere;

use WP_Query;
use WP_REST_Controller;

if (!defined('ABSPATH')) {
    exit;
}

class Ajax_Handler extends WP_REST_Controller
{
    public static function init()
    {
        add_action('wp_ajax_get_posts_by_type', [__CLASS__, 'get_posts_by_type']);
        add_action('wp_ajax_nopriv_get_posts_by_type', [__CLASS__, 'get_posts_by_type']);
    }

    public static function get_posts_by_type()
    {
        // Security check (allow requests only with a valid nonce)
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cfa_nonce')) {
            wp_send_json_error('Invalid nonce');
            return;
        }

        $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';

        error_log("Fetching posts for post type: " . $post_type);

        $args = [
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $query = new WP_Query($args);
        $posts = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $posts[get_the_ID()] = get_the_title();
            }
            wp_reset_postdata();
        }

        error_log("Posts found: " . print_r($posts, true));

        wp_send_json_success($posts);
    }

}

// Initialize AJAX handler
Ajax_Handler::init();
