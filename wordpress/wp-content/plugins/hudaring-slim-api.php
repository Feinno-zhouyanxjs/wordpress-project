<?php
/**
 * Plugin Name: Hudaring Like API
 * Description: Provides a custom REST API endpoint for post data including like count and featured image.
 * Version: 1.0
 * Author: hudaring
 */

add_action('rest_api_init', function () {
    register_rest_route('hudaring/v1', '/posts', [
        'methods' => 'GET',
        'callback' => 'hudaring_custom_posts',
        'permission_callback' => '__return_true'
    ]);
});

function hudaring_custom_posts($request) {
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $request->get_param('per_page') ?: 5,
    ];

    $query = new WP_Query($args);
    $posts = [];

    foreach ($query->posts as $post) {
        $post_id = $post->ID;
        $featured_id = get_post_thumbnail_id($post_id);
        $featured_post = $featured_id ? get_post($featured_id) : null;
        $media_details = $featured_id ? wp_get_attachment_metadata($featured_id) : null;
        $image_url = $featured_id ? wp_get_attachment_url($featured_id) : null;

        $posts[] = [
            'id' => $post_id,
            'slug' => $post->post_name,
            'title' => get_the_title($post_id),
            'like_count' => (int) get_post_meta($post_id, 'hudaring_like_count', true),
            'featured_image' => $featured_id ? [
                'id' => $featured_id,
                'slug' => $featured_post->post_name,
                'title' => $featured_post->post_title,
                'source_url' => $image_url,
                'media_details' => $media_details
            ] : null
        ];
    }

    return rest_ensure_response($posts);
}