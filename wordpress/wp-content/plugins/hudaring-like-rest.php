<?php
/**
 * Plugin Name: Hudaring Like REST API
 * Description: Adds a public REST API endpoint to increment like count for posts.
 * Version: 1.0
 * Author: hudaring
 */

add_action('rest_api_init', function () {
    register_rest_route('hudaring/v1', '/like', [
        'methods' => ['POST', 'GET'],
        'callback' => 'hudaring_increment_like',
        'permission_callback' => '__return_true', // ✅ No auth required
        'args' => [
            'post_id' => [
                'required' => true,
                'type' => 'integer'
            ]
        ]
    ]);
});

function hudaring_increment_like($request) {
    global $wpdb;

    $post_id = $request->get_param('post_id');
    $meta_key = 'hudaring_like_count';

    if (!$post_id || get_post_status($post_id) === false) {
        return new WP_Error('invalid_post', 'Invalid post ID', ['status' => 400]);
    }

    // Ensure atomic update
    $wpdb->query($wpdb->prepare(
        "INSERT INTO {$wpdb->postmeta} (post_id, meta_key, meta_value)
         VALUES (%d, %s, 1)
         ON DUPLICATE KEY UPDATE meta_value = meta_value + 1",
        $post_id,
        $meta_key
    ));

    $new_count = (int) get_post_meta($post_id, $meta_key, true);

    return rest_ensure_response([
        'success' => true,
        'count' => $new_count
    ]);
}