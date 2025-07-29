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

add_action('save_post_post', function ($post_id, $post, $update) {
    // Skip autosaves, revisions, and non-published statuses
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    if ($post->post_status !== 'publish') return;

    // Check if like count already exists
    $meta_key = 'hudaring_like_count';
    $existing = get_post_meta($post_id, $meta_key, true);

    if ($existing === '' || $existing === false) {
        $random = rand(66, 198);
        update_post_meta($post_id, $meta_key, $random);

        // Optional log for debugging
        if (defined('WP_DEBUG') && WP_DEBUG === true) {
            error_log("Like count initialized for post $post_id with $random");
        }
    }
}, 10, 3);

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