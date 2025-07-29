<?php
/**
 * Plugin Name: Hudaring Like REST API
 * Description: Adds a public REST API endpoint to increment like count for posts.
 * Version: 1.1
 * Author: hudaring
 */

// Register REST API endpoint
add_action('rest_api_init', function () {
    register_rest_route('hudaring/v1', '/like', [
        'methods' => ['POST', 'GET'],
        'callback' => 'hudaring_increment_like',
        'permission_callback' => '__return_true',
        'args' => [
            'post_id' => [
                'required' => true,
                'type' => 'integer'
            ]
        ]
    ]);
});

// Initialize default like count on first publish
add_action('save_post', function ($post_id) {
    // Only apply to standard posts
    if (get_post_type($post_id) !== 'post') {
        return;
    }

    // Avoid autosave loops
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Avoid updates from revisions, drafts, or trash
    if (wp_is_post_revision($post_id) || get_post_status($post_id) !== 'publish') {
        return;
    }

    // Set random like count only if it hasn't been set
    $meta_key = 'hudaring_like_count';
    $existing = get_post_meta($post_id, $meta_key, true);

    if ($existing === '' || $existing === false) {
        $random = rand(66, 198);
        update_post_meta($post_id, $meta_key, $random);
    }
});

// Like count REST API logic
function hudaring_increment_like($request) {
    global $wpdb;

    $post_id = $request->get_param('post_id');
    $meta_key = 'hudaring_like_count';

    if (!$post_id || get_post_status($post_id) === false) {
        return new WP_Error('invalid_post', 'Invalid post ID', ['status' => 400]);
    }

    // Atomic insert-or-increment query
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