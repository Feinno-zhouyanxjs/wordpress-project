<?php
/**
 * Plugin Name: Hudaring Slim API
 * Description: Custom REST endpoint that returns minimal post data with like count and featured image.
 * Version: 1.1
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
        $images = [];

        if ($featured_id) {
            $attachment = get_post($featured_id);
            $media_details = wp_get_attachment_metadata($featured_id);
            $image_url = wp_get_attachment_url($featured_id);
            $file_name = $media_details['file'] ?? null;

            $images[] = [
                'id' => $featured_id,
                'slug' => $attachment->post_name,
                'title' => $attachment->post_title,
                'source_url' => $image_url,
                'file' => $file_name,
                'width' => $media_details['width'] ?? null,
                'height' => $media_details['height'] ?? null
            ];
        }

        $posts[] = [
            'id' => $post_id,
            'slug' => $post->post_name,
            'title' => get_the_title($post_id),
            'date' => get_the_date('c', $post_id),
            'modified' => get_the_modified_date('c', $post_id),
            'link' => get_permalink($post_id),
            'like_count' => (int) get_post_meta($post_id, 'hudaring_like_count', true),
            'featured_image' => $images
        ];
    }

    return rest_ensure_response($posts);
}