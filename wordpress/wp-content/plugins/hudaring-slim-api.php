<?php
/**
 * Plugin Name: Hudaring Slim API
 * Description: Custom REST endpoint that returns minimal post data with like count and featured image, using accurate upload date in URLs.
 * Version: 1.8
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
    $per_page = $request->get_param('per_page') ?: 5;
    $page = $request->get_param('page') ?: 1;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => $per_page,
        'paged'          => $page,
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
            $alt_text = get_post_meta($featured_id, '_wp_attachment_image_alt', true);
            $mime_type = $attachment->post_mime_type;
            $attachment_date = $attachment->post_date;

            $file_path = $media_details['file'] ?? null;
            $upload_dir = wp_upload_dir();
            $baseurl = trailingslashit($upload_dir['baseurl']);

            // Build source_url from the correct relative file path
            $source_url = $file_path ? $baseurl . $file_path : null;

            // Generate resized_files using same folder as base file
            $resized_files = [];
            if ($file_path && strpos($file_path, '.') !== false) {
                $dot_pos = strrpos($file_path, '.');
                $name_only = substr($file_path, 0, $dot_pos);
                $ext = substr($file_path, $dot_pos);

                $postfixes = ['1024x1024', '500x500', '300x300', '150x150'];
                foreach ($postfixes as $size) {
                    $resized_files[$size] = $baseurl . $name_only . '-' . $size . $ext;
                }
            }

            $images[] = [
                'id' => $featured_id,
                'slug' => $attachment->post_name,
                'title' => $attachment->post_title,
                'source_url' => $source_url,
                'file' => $file_path,
                'width' => $media_details['width'] ?? null,
                'height' => $media_details['height'] ?? null,
                'alt_text' => $alt_text,
                'mime_type' => $mime_type,
                'post_date' => $attachment_date,
                'resized_files' => $resized_files
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