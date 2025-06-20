<?php
/**
 * Plugin Name: Hudaring Like Count Integration
 * Description: Merge custom post meta data into the REST API response.
 * Version: 1.0
 * Author: hudaring
 */
   add_action('init', function () {
       register_post_meta(
           'post',
           'hudaring_like_count',
           [
               'show_in_rest' => true,
               'single' => true,
               'type' => 'integer',
               'default' => 0,
           ]
       );
   });